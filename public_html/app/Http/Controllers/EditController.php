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
            'selectTitle' => 'required',
            'sex' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'birthdate' => 'required',
            'baseEdu' => 'required',
            'orcid' => 'required',
            'scopus' => 'required',
            'math-net' => 'required',
            'clarivate' => 'required'
        ]);
        // print_r($validate['FIO']);
        $employee = Employee::find($id);
        $fioSplited = explode(" ", $validate['FIO']);
        if (count($fioSplited) < 3) {
            return redirect('/edit/' . $id)->withErrors(['ФИО указано неверно']);
        }
        // print_r($validate);

        $employee->surname = $fioSplited[0];
        $employee->name = $fioSplited[1];
        $employee->patronimyc = $fioSplited[2];
        $employee->sex = $validate['sex'];
        $employee->address = $validate['address'];
        $employee->phone = $validate['phone'];
        $employee->email = $validate['email'];
        $employee->birthdate = $validate['birthdate'];
        $employee->base_education = $validate['baseEdu'];
        $employee->orcid_url = $validate['orcid'];
        $employee->scopus_url = $validate['scopus'];
        $employee->mathnet_url = $validate['math-net'];
        $employee->clarivate_url = $validate['clarivate'];
        $employee->save();

        $emplDegree = $employee->emplDegree;
        $emplDegree->degree_id = $validate['selectDegree'];
        $emplDegree->save();

        $emplTitle = $employee->emplTitle;
        $emplTitle->title_id = $validate['selectTitle'];
        $emplTitle->save();

        session()->flash('success', 'Успешно сохранено!');

        return redirect('/edit/' . $id);
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

    function create(Request $request)
    {
        $request->flash();
        $validate = $request->validate([
            'FIO' => 'required|string|max:255',
            'selectDegree' => 'required',
            'selectTitle' => 'required',
            'sex' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'birthdate' => 'required',
            'baseEdu' => 'required',
            'orcid' => 'required',
            'scopus' => 'required',
            'math-net' => 'required',
            'clarivate' => 'required'
        ]);

        $fioSplited = explode(" ", $validate['FIO']);
        if (count($fioSplited) < 3) {
            return redirect('/create-user')->withErrors(['ФИО указано неверно']);
        }
        $credentials = [
            'surname' => $fioSplited[0],
            'name' => $fioSplited[1],
            'patronimyc' => $fioSplited[2],
            'address' => $validate['address'],
            'birthdate' => $validate['birthdate'],
            'sex' => $validate['sex'],
            'phone' => $validate['phone'],
            'email' => $validate['email'],
            'base_education' => $validate['baseEdu'],
            'orcid_url' => $validate['orcid'],
            'scopus_url' => $validate['scopus'],
            'mathnet_url' => $validate['math-net'],
            'clarivate_url' => $validate['clarivate']
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

        session()->flash('success', 'Успешно сохранено!');
        return redirect('/create-user');
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

        $address = $employee->address;
        $birthdate = $employee->birthdate;
        $phone = $employee->phone;
        $email = $employee->email;
        $sex = $employee->sex;
        $baseEdu = $employee->base_education;
        $orcid = $employee->orcid_url;
        $scopus = $employee->scopus_url;
        $mathnet = $employee->mathnet_url;
        $clarivate = $employee->clarivate_url;

        return view(
            'profileEditing',
            [
                'id' => $id,
                'fio' => $fio,
                'emplDegree' => $emplDegree,
                'degree' => $degree,
                'emplTitle' => $emplTitle,
                'title' => $title,
                'address' => $address,
                'birthdate' => $birthdate,
                'phone' => $phone,
                'email' => $email,
                'sex' => $sex,
                'baseEdu' => $baseEdu,
                'orcid' => $orcid,
                'scopus' => $scopus,
                'mathnet' => $mathnet,
                'clarivate' => $clarivate
            ]
        );
    }
}
