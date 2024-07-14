<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\EmplContract;
use App\Models\EmplContractType;
use App\Models\Employee;
use App\Models\Position;
use Carbon\Carbon;

class ContractController extends Controller
{
    function showContracts()
    {
        $contracts = EmplContract::all();
        $employees = Employee::all();
        $positions = Position::all();

        foreach ($contracts as $contract) {
            $contract->fillFieldsNullValues();

            $contract->warning_class = '';
            $contract->warning_message = '';
            $now = Carbon::now();
            $date_to = Carbon::parse($contract->date_to);

            if ($date_to->isPast()) {
                $contract->warning_class = 'expired';
                $contract->warning_message = 'Срок действия договора истёк.';
            } elseif ($date_to->diffInMonths($now) < 6) {
                $contract->warning_class = 'expiring';
                $contract->warning_message = 'Срок действия договора истекает в течение 6 месяцев.';
            }
        }

        return view(
            'contracts',
            [
                'contracts' => $contracts,
                'employees' => $employees,
                'positions' => $positions
            ]
        );
    }

    function showContractsAdd()
    {
        $employees = Employee::all();
        $positions = Position::all();
        $emplTypes = EmplContractType::all();
        $departments = Department::all()->sortBy('title');

        // $emplFIOs = array();
        // foreach ($employees as $empl) {
        //     $fio = sprintf('%s %s %s', $empl->surname, $empl->name, $empl->patronimyc);
        //     $emplFIOs[] = ['id' => $empl->id, 'fio' => $fio];
        // }

        return view(
            'addContract',
            compact('employees', 'positions', 'emplTypes', 'departments')
        );
    }

    function showContractUpdate($id)
    {
        $contract = EmplContract::find($id);
        $contract->fillFieldsNullValues();

        $employees = Employee::all();
        $positions = Position::all();
        $emplTypes = EmplContractType::all();
        $departments = Department::all()->sortBy('title');

        $emplTypeId = !is_null($contract->emplContractType)
            ? $contract->emplContractType->id
            : 0;

        return view('EmplContracts.updateContract', compact(
            'contract',
            'employees',
            'positions',
            'emplTypes',
            'emplTypeId',
            'departments'
        ));
    }

    function updateContract(Request $request, $id)
    {

        $validated = $request->validate([
            'emplId' => 'required',
            'number' => 'required|int',
            'position_id' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'empl-type_id' => 'required',
            'department_id' => 'required'
        ]);

        $credentials = [
            'employee_id' => $validated['emplId'],
            'date_from' => $validated['date_from'],
            'date_to' => $validated['date_to'],
            'number' => $validated['number'],
            'position_id' => $validated['position_id'],
            'empl_contract_type' => $validated['empl-type_id'],
            'department_id' => $validated['department_id']
        ];

        $contract = EmplContract::findOrFail($id);
        $contract->update($credentials);

        session()->flash('success', 'Успешно обновлено!');
        return redirect()->back();
    }

    function addContract(Request $request)
    {
        $request->flash();
        $validate = $request->validate([
            'emplId' => 'required',
            'number' => 'required|int',
            'position_id' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'empl-type_id' => 'required',
            'department_id' => 'required'
        ]);

        $credentials = [
            'employee_id' => $validate['emplId'],
            'date_from' => $validate['date_from'],
            'date_to' => $validate['date_to'],
            'number' => $validate['number'],
            'position_id' => $validate['position_id'],
            'empl_contract_type' => $validate['empl-type_id'],
            'department_id' => $validate['department_id']
        ];

        EmplContract::create($credentials);
        session()->flash('success', 'Успешно сохранено!');
        return redirect()->route('contracts.list');
    }

    function deleteContract($id)
    {
        EmplContract::destroy($id);

        return redirect(route('contracts.list'));
    }

    public function filter(Request $request)
    {
        $sort = $request->input('sort');
        if ($sort) {
            $sort_by = explode('-', $sort)[0];
            $sort_order = explode('-', $sort)[1];
        } else {
            $sort_by = 'none';
        }

        $query = EmplContract::query();

        // Сортировка
        if ($sort_by == 'fio') {
            $query->join('employees', 'empl_contracts.employee_id', '=', 'employees.id')
                ->orderBy('employees.surname', $sort_order)
                ->orderBy('employees.name', $sort_order)
                ->orderBy('employees.patronimyc', $sort_order);
        } else if ($sort_by == 'position') {
            $query->join('positions', 'empl_contracts.position_id', '=', 'positions.id')
                ->orderBy('positions.title', $sort_order);
        } else if ($sort_by == 'date_to') {
            $query->orderBy('date_to', $sort_order);
        }

        $contracts = $query->with(['employee', 'department', 'position', 'emplContractType'])->get();

        foreach ($contracts as $contract) {
            $contract->fillFieldsNullValues();

            $contract->warning_class = '';
            $contract->warning_message = '';
            $now = Carbon::now();
            $date_to = Carbon::parse($contract->date_to);

            if ($date_to->isPast()) {
                $contract->warning_class = 'expired';
                $contract->warning_message = 'Срок действия договора истёк.';
            } elseif ($date_to->diffInMonths($now) < 6) {
                $contract->warning_class = 'expiring';
                $contract->warning_message = 'Срок действия договора истекает в течение 6 месяцев.';
            }
        }


        return view('contracts', compact('contracts'));
    }
}
