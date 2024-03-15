<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function showEmployees()
    {
        $empls = Employee::all();
        return view("showEmployees", compact("empls"));
    }
}
