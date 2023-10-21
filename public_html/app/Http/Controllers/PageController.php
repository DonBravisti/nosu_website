<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    function goToDepartment(){
        $employees = DB::table('employees')->get();
        $degrees = DB::table('degrees')->get();
        $emplDegrees = DB::table('empl_degrees')->get();
        
        $emplFIOs = array();
        for ($i=0; $i < count($employees); $i++) { 
            $degreeTableId = $emplDegrees->where('employee_id', $employees[$i]->id)->value('degree_id') - 1;
            $emplDegree = $degrees[$degreeTableId];
            $fio = sprintf('%s %s %s', $employees[$i]->surname, $employees[$i]->name, $employees[$i]->patronimyc);

            $emplFIOs[] = ['fio' => $fio, 'degree' => $emplDegree->title];
        }
        
        return view('department', ['emplFIOs' => $emplFIOs]);
    }

    function goToPersonalCard(){
        return view('persCard');
    }

    function goToStructure(){
        return view('structure');
    }

    function goToProfileEditing(){
        return view('department');
    }
}
