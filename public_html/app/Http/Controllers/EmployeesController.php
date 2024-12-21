<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class EmployeesController extends Controller
{
    function showEmployees()
    {
        $faculty_id = Config::get('faculty.default_faculty_id');
        $empls = Employee::with('departments') // Загружаем связанные кафедры
        ->where('deleted', false)
        ->get()
        ->sortBy('Fio');
        $departments = Department::all()->where('faculty_id', $faculty_id)->sortBy('title');

        return view("showEmployees", compact("empls", "departments"));
    }

    function sortFilter(Request $request)
    {
        $showDeleted = $request->input('show_deleted');
        $sortBy = $request->input('sort');
        $depId = $request->input('filter');
        $empls = [];

        if ($depId) {
            $dep = Department::find($depId);
            $linkedContracts = $dep->emplContracts;

            foreach ($linkedContracts as $contract) {
                $empl = $contract->employee;

                // Учитываем только сотрудников с меткой "удален", если выбран чекбокс
                if ($showDeleted || !$empl->deleted) {
                    $empls[$empl->Fio] = $empl;
                }
            }
            $empls = array_unique($empls);
        } else {
            foreach (Employee::all() as $empl) {
                if ($showDeleted || !$empl->deleted) {
                    $empls[$empl->Fio] = $empl;
                }
            }
        }

        if (!empty($empls)) {
            $sortBy ? krsort($empls) : ksort($empls);
        }

        $faculty_id = Config::get('faculty.default_faculty_id');
        $departments = Department::all()->where('faculty_id', $faculty_id)->sortBy('title');

        return view("showEmployees", compact("empls", "departments", "sortBy", "depId", "showDeleted"));
    }
}
