<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    function goToDepartment()
    {
        $employees = DB::table('employees')->get();
        $degrees = DB::table('degrees')->get();
        $emplDegrees = DB::table('empl_degrees')->get();

        $emplFIOs = array();
        for ($i = 0; $i < count($employees); $i++) {
            $emplDegree = $this->getEmployeeDegree($employees[$i]->id, $emplDegrees, $degrees);
            $fio = sprintf('%s %s %s', $employees[$i]->surname, $employees[$i]->name, $employees[$i]->patronimyc);

            $emplFIOs[] = ['id' => $employees[$i]->id, 'fio' => $fio, 'degree' => $emplDegree];
        }

        return view('department', ['emplFIOs' => $emplFIOs]);
    }

    private function getEmployeeDegree($emplID, $emplDegrees, $degrees)
    {
        $degreeTableId = $emplDegrees->where('employee_id', $emplID)->value('degree_id') - 1;
        return $degrees[$degreeTableId]->title;
    }

    function goToPersonalCard($id)
    {
        $employee = Employee::all()->where('id', $id)->first();
        $degrees = DB::table('degrees')->get();
        $emplDegrees = DB::table('empl_degrees')->get();
        $emplDegree = $this->getEmployeeDegree($id, $emplDegrees, $degrees);

        return view('persCard', [
            'fio' => sprintf('%s %s %s', $employee->surname, $employee->name, $employee->patronimyc), 
            'degree' => $emplDegree
        ]);
    }

    function goToStructure()
    {
        return view('structure');
    }
}
