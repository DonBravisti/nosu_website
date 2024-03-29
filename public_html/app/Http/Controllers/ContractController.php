<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmplContract;
use App\Models\EmplContractType;
use App\Models\Employee;
use App\Models\Position;

class ContractController extends Controller
{
    function showContracts()
    {
        $contracts = EmplContract::all();
        $employees = Employee::all();
        $positions = Position::all();

        foreach ($contracts as $contract) {
            $contract->fillFieldsNullValues();
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

        $emplFIOs = array();
        foreach ($employees as $empl) {
            $fio = sprintf('%s %s %s', $empl->surname, $empl->name, $empl->patronimyc);
            $emplFIOs[] = ['id' => $empl->id, 'fio' => $fio];
        }

        return view(
            'addContract',
            [
                'employees' => $emplFIOs,
                'positions' => $positions,
                'emplTypes' => $emplTypes
            ]
        );
    }

    function showContractUpdate($id)
    {
        $contract = EmplContract::find($id);

        $employees = Employee::all();
        $positions = Position::all();
        $emplTypes = EmplContractType::all();

        $emplTypeId = !is_null($contract->emplContractType)
            ? $contract->emplContractType->id
            : 0;

        return view('EmplContracts.updateContract', [
            'contract' => $contract,
            'employees' => $employees,
            'positions' => $positions,
            'emplTypes' => $emplTypes,
            'emplTypeId' => $emplTypeId
        ]);
    }

    function updateContract(Request $request, $id) {

        $validated = $request->validate([
            'emplId' => 'required',
            'number' => 'required|int',
            'position_id' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'empl-type_id' => 'required'
        ]);

        $credentials = [
            'employee_id' => $validated['emplId'],
            'date_from' => $validated['date_from'],
            'date_to' => $validated['date_to'],
            'number' => $validated['number'],
            'position_id' => $validated['position_id'],
            'empl_contract_type' => $validated['empl-type_id']
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
            'empl-type_id' => 'required'
        ]);

        $credentials = [
            'employee_id' => $validate['emplId'],
            'date_from' => $validate['date_from'],
            'date_to' => $validate['date_to'],
            'number' => $validate['number'],
            'position_id' => $validate['position_id'],
            'empl_contract_type' => $validate['empl-type_id']
        ];

        EmplContract::create($credentials);
        session()->flash('success', 'Успешно сохранено!');
        return redirect()->route('contracts.list');
    }

    function deleteContract($id) {
        EmplContract::destroy($id);

        return redirect(route('contracts.list'));
    }
}
