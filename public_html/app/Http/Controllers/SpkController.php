<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmplProfEducation;
use Illuminate\Http\Request;

class SpkController extends Controller
{
    function goToSpkList () {
        $spk = EmplProfEducation::all();
        return view('spk', ['spk' => $spk]);
    }

    function goToSpkAdd() {
        $empls = Employee::all();
        return view('spkAdd', ['empls' => $empls]);
    }
}
