<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmplDegree;
use App\Models\EmplTitle;
use Illuminate\Support\Facades\DB;

class EditController extends Controller
{
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'FIO' => 'required|string|max:255',
            'selectDegree' => 'required',
            'selectTitle' => 'required'
        ]);
        // print_r($validate['FIO']);
        $employee = Employee::find($id);
        $fioSplited = explode(" ", $validate['FIO']);

        $employee->surname = $fioSplited[0];
        $employee->name = $fioSplited[1];
        $employee->patronimyc = $fioSplited[2];
        $employee->save();

        $emplDegree = $employee->emplDegree;
        $emplDegree->degree_id = $validate['selectDegree'];
        $emplDegree->save();

        $emplTitle = $employee->emplTitle;
        $emplTitle->title_id = $validate['selectTitle'];
        $emplTitle->save();

        return redirect('/kafedra-prikladnoj-matematiki-i-informatiki');
    }

    public function save(Request $request)
    {
        $request->validate([
            'FIO' => 'required|string|max:255'
        ]);
        $request_splited = explode(" ", $request->FIO);

        $credentials = [
            'surname' => $request_splited[0],
            'name' => $request_splited[1],
            'patronimyc' => $request_splited[2]
        ];

        // Employee::create($credentials);

        print_r($credentials);
    }

    function showCreationForm()
    {
        $degrees = DB::table('degrees')->get();
        $titles = DB::table('titles')->get();
        return view(
            'profileCreation',
            [
                'fio' => 'Новый сотрудник',
                'degrees' => $degrees,
                'titles' => $titles
            ]
        );
    }

    function create(Request $request)
    {
        $validate = $request->validate([
            'FIO' => 'required|string|max:255',
            'selectDegree' => 'required',
            'selectTitle' => 'required'
        ]);

        $fioSplited = explode(" ", $validate['FIO']);
        $credentials = [
            'surname' => $fioSplited[0],
            'name' => $fioSplited[1],
            'patronimyc' => $fioSplited[2],
            'address' => 'address',
            'birthdate' => '1900-01-01',
            'sex' => 0,
            'phone' => '',
            'email' => ''
        ];

        $employee = Employee::create($credentials);

        $emplDegree = new EmplDegree();
        $emplDegree->degree_id = $validate['selectDegree'];
        $emplDegree->spec_id = 1;
        $employee->emplDegree()->save($emplDegree);

        $emplTitle = new EmplTitle();
        $emplTitle->title_id = $validate['selectTitle'];
        $emplTitle->date = '1900-01-01';
        $employee->emplTitle()->save($emplTitle);

        // echo 'da';
        return redirect('/kafedra-prikladnoj-matematiki-i-informatiki');
    }

    private function getEmployeeDegree($emplID, $emplDegrees, $degrees)
    {
        $degreeTableId = $emplDegrees->where('employee_id', $emplID)->value('degree_id') - 1;
        return $degrees[$degreeTableId];
    }

    private function getEmployeeTitle($emplID, $emplTitles, $titles)
    {
        $titleTableId = $emplTitles->where('employee_id', $emplID)->value('title_id') - 1;
        return $titles[$titleTableId];
    }

    function goToProfileEditing($id)
    {
        $employee = Employee::all()->where('id', $id)->first();
        $fio = sprintf('%s %s %s', $employee->surname, $employee->name, $employee->patronimyc);

        $degrees = DB::table('degrees')->get();
        $emplDegrees = DB::table('empl_degrees')->get();
        $emplDegree = $this->getEmployeeDegree($id, $emplDegrees, $degrees);
        $degree = $emplDegree->id == 1 ? $degrees[1] : $degrees[0];

        $titles = DB::table('titles')->get();
        $emplTitles = DB::table('empl_titles')->get();
        $emplTitle = $this->getEmployeeTitle($id, $emplTitles, $titles);
        $title = $emplTitle->id == 1 ? $titles[1] : $titles[0];

        return view(
            'profileEditing',
            [
                'id' => $id,
                'fio' => $fio,
                'emplDegree' => $emplDegree,
                'degree' => $degree,
                'emplTitle' => $emplTitle,
                'title' => $title
            ]
        );
    }
}
