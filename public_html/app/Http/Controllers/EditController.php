<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EditController extends Controller
{
    public function save(Request $request){
        $request->validate([
            'FIO' => 'required|string|max:255'
        ]);
        $request_splited = explode(" ", $request->FIO);

        $credentials = [
            'surname' => $request_splited[0],
            'name' => $request_splited[1],
            'patronimyc'=> $request_splited[2]
        ];

        // Employee::create($credentials);

        print_r($credentials);
    }

    function showCreationForm() {
        return view('profileCreation', ['fio' => 'Новый сотрудник']);
    }

    function create() {
        echo 'da';
    }

    private function getEmployeeDegree($emplID, $emplDegrees, $degrees)
    {
        $degreeTableId = $emplDegrees->where('employee_id', $emplID)->value('degree_id') - 1;
        return $degrees[$degreeTableId]->title;
    }

    function goToProfileEditing($id)
    {
        $employee = Employee::all()->where('id', $id)->first();
        $degrees = DB::table('degrees')->get();
        $emplDegrees = DB::table('empl_degrees')->get();
        $emplDegree = $this->getEmployeeDegree($id, $emplDegrees, $degrees);
        $fio = sprintf('%s %s %s', $employee->surname, $employee->name, $employee->patronimyc);
        return view('profileEditing', ['fio' => $fio, 'degree' => $emplDegree]);
    }
}
