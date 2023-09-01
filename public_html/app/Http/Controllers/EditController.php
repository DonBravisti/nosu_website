<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

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
}
