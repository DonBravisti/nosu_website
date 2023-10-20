<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    function goToDepartment(){
        return view('department');
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
