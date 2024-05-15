<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    function showEmployees()
    {
        $empls = Employee::all()->sortBy('Fio');
        $departments = Department::all()->sortBy('title');

        return view("showEmployees", compact("empls", "departments"));
    }

    function sortFilter(Request $request)
    {
        $sortBy = $request->input('sort');
        $depId = $request->input('filter');
        $empls = [];

        if ($depId) {
            $dep = Department::find($depId);
            $linkedContracts = $dep->emplContracts;
            foreach ($linkedContracts as $contract) {
                $empl =$contract->employee;
                $empls[$empl->Fio] = $empl;
            }
            $empls = array_unique($empls);
        } else {
            foreach (Employee::all() as $empl) {
                $empls[$empl->Fio] = $empl;
            }
            // return redirect(route('empls.list'));
        }

        if (!empty($empls)) {
            $sortBy ? krsort($empls) : ksort($empls);
        }
        $departments = Department::all()->sortBy('title');

        // print_r($empls);
        return view("showEmployees", compact("empls", "departments", "sortBy", "depId"));
    }
}
