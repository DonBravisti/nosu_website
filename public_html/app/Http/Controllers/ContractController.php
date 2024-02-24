<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmplContract;
use App\Models\Employee;
use App\Models\Position;

class ContractController extends Controller
{
    function showContracts()
    {
        $contracts = EmplContract::all();
        $employees = Employee::all();
        $positions = Position::all();

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

        $emplFIOs = array();
        foreach ($employees as $empl) {
            $fio = sprintf('%s %s %s', $empl->surname, $empl->name, $empl->patronimyc);
            $emplFIOs[] = ['id' => $empl->id, 'fio' => $fio];
        }

        return view(
            'addContract',
            [
                'employees' => $emplFIOs,
                'positions' => $positions
            ]
        );
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
            'competition' => 'required'
        ]);

        $credentials = [
            'employee_id' => $validate['emplId'],
            'date_from' => $validate['date_from'],
            'date_to' => $validate['date_to'],
            'number' => $validate['number'],
            'position_id' => $validate['position_id'],
            'competition' => $validate['competition']
        ];

        EmplContract::create($credentials);
        session()->flash('success', 'Успешно сохранено!');
        return redirect()->route('contracts.list');
    }
}
