<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Department;
use App\Models\EmplContract;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmplDegree;
use App\Models\EmplProfEducation;
use App\Models\EmplPublication;
use App\Models\EmplTitle;
use App\Models\Title;
use App\Models\TitlePlan;
use Illuminate\Support\Facades\DB;

class EditController extends Controller
{
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'FIO' => 'required|string|max:255',
            'degree_1' => 'required|integer',
            'degree_2' => 'nullable|integer',
            'selectTitle' => 'required|integer',
            'sex' => 'required|string',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'birthdate' => 'nullable|date',
            'bachelor_speciality' => 'nullable|string|max:255',
            'master_speciality' => 'nullable|string|max:255',
            'specialist_speciality' => 'nullable|string|max:255',
            'phd_speciality' => 'nullable|string|max:255',
            'bachelor_qualification' => 'nullable|string|max:255',
            'master_qualification' => 'nullable|string|max:255',
            'specialist_qualification' => 'nullable|string|max:255',
            'phd_qualification' => 'nullable|string|max:255',
            'orcid' => 'nullable|url',
            'scopus' => 'nullable|url',
            'math-net' => 'nullable|url',
            'clarivate' => 'nullable|url'
        ]);
        // print_r($validate['FIO']);
        $employee = Employee::find($id);
        $fioSplited = explode(" ", $validate['FIO']);
        if (count($fioSplited) < 3) {
            return redirect(route('empls.edit', ['id' => $id]))->withErrors(['ФИО указано неверно']);
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
        $employee->bachelor_speciality = $validate['bachelor_speciality'];
        $employee->master_speciality = $validate['master_speciality'];
        $employee->specialist_speciality = $validate['specialist_speciality'];
        $employee->phd_speciality = $validate['phd_speciality'];
        $employee->bachelor_qualification = $validate['bachelor_qualification'];
        $employee->master_qualification = $validate['master_qualification'];
        $employee->specialist_qualification = $validate['specialist_qualification'];
        $employee->phd_qualification = $validate['phd_qualification'];
        $employee->orcid_url = $validate['orcid'];
        $employee->scopus_url = $validate['scopus'];
        $employee->mathnet_url = $validate['math-net'];
        $employee->clarivate_url = $validate['clarivate'];
        $employee->save();

        $emplDegree = $employee->emplDegrees[0];
        $emplDegree->degree_id = $validate['degree_1'];
        $emplDegree->save();

        if (count($employee->emplDegrees) == 2) {
            $emplDegree = $employee->emplDegrees[1];
            $emplDegree->degree_id = $validate['degree_2'];
            $emplDegree->save();
        } else if ($validate['degree_2'] != 9) {
            $employee->emplDegrees()->create([
                'degree_id' => $validate['degree_2'],
                'spec_id' => 1
            ]);
        }

        $emplTitle = $employee->emplTitle;
        $emplTitle->title_id = $validate['selectTitle'];
        $emplTitle->save();

        session()->flash('success', 'Успешно сохранено!');

        return redirect()->route('empls.edit', ['id' => $id]);
    }

    // public function save(Request $request)
    // {
    //     $request->validate([
    //         'FIO' => 'required|string|max:255'
    //     ]);
    //     $request_splited = explode(" ", $request->FIO);

    //     $credentials = [
    //         'surname' => $request_splited[0],
    //         'name' => $request_splited[1],
    //         'patronimyc' => $request_splited[2]
    //     ];

    //     // Employee::create($credentials);

    //     print_r($credentials);
    // }

    function create(Request $request)
    {
        $request->flash();

        // Валидация
        $validate = $request->validate([
            'FIO' => 'required|string|max:255',
            'degree_1' => 'required|integer',
            'degree_2' => 'nullable|integer',
            'selectTitle' => 'required|integer',
            'sex' => 'required|string',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'birthdate' => 'nullable|date',
            'bachelor_speciality' => 'nullable|string|max:255',
            'master_speciality' => 'nullable|string|max:255',
            'specialist_speciality' => 'nullable|string|max:255',
            'phd_speciality' => 'nullable|string|max:255',
            'bachelor_qualification' => 'nullable|string|max:255',
            'master_qualification' => 'nullable|string|max:255',
            'specialist_qualification' => 'nullable|string|max:255',
            'phd_qualification' => 'nullable|string|max:255',
            'orcid' => 'nullable|url',
            'scopus' => 'nullable|url',
            'math-net' => 'nullable|url',
            'clarivate' => 'nullable|url'
        ]);

        // Разделение ФИО
        $fioSplited = explode(" ", $validate['FIO']);
        if (count($fioSplited) < 3) {
            return redirect()->back()->withErrors(['ФИО указано неверно']);
        }

        // Создание сотрудника
        $employee = Employee::create([
            'surname' => $fioSplited[0],
            'name' => $fioSplited[1],
            'patronimyc' => $fioSplited[2],
            'address' => $validate['address'] ?? null,
            'birthdate' => $validate['birthdate'] ?? null,
            'sex' => $validate['sex'],
            'phone' => $validate['phone'] ?? null,
            'email' => $validate['email'] ?? null,
            'base_education' => $validate['baseEdu'] ?? null,
            'qualification' => $validate['qualification'] ?? null,
            'bachelor_speciality' => $validate['bachelor_speciality'] ?? null,
            'master_speciality' => $validate['master_speciality'] ?? null,
            'specialist_speciality' => $validate['specialist_speciality'] ?? null,
            'phd_speciality' => $validate['phd_speciality'] ?? null,
            'bachelor_qualification' => $validate['bachelor_qualification'] ?? null,
            'master_qualification' => $validate['master_qualification'] ?? null,
            'specialist_qualification' => $validate['specialist_qualification'] ?? null,
            'phd_qualification' => $validate['phd_qualification'] ?? null,
            'orcid_url' => $validate['orcid'] ?? null,
            'scopus_url' => $validate['scopus'] ?? null,
            'mathnet_url' => $validate['math-net'] ?? null,
            'clarivate_url' => $validate['clarivate'] ?? null
        ]);

        // Присвоение 1 ученой степени
        $employee->emplDegrees()->create([
            'degree_id' => $validate['degree_1'],
            'spec_id' => 1
        ]);

        // Присвоение 2 ученой степени
        if ($validate['degree_2'] != 9) {
            $employee->emplDegrees()->create([
                'degree_id' => $validate['degree_2'],
                'spec_id' => 1
            ]);
        }

        // Присвоение ученого звания
        $employee->emplTitle()->create([
            'title_id' => $validate['selectTitle'],
            'date' => '1900-01-01' // Возможно, стоит сделать динамическим
        ]);

        // Успешное выполнение
        return redirect()->route('empls.list')->with('success', 'Успешно сохранено!');
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

    public function goToProfileEditing($id)
    {
        $employee = Employee::with(['emplDegrees', 'emplTitle'])->findOrFail($id);

        return view('profileEditing', [
            'id' => $employee->id,
            'fio' => $employee->FIO(),
            'emplDegree1' => $employee->emplDegrees[0] ?? new EmplDegree(['degree_id' => 9]),
            'emplDegree2' => $employee->emplDegrees[1] ?? new EmplDegree(['degree_id' => 9]),
            'degrees' => Degree::all(),
            'emplTitle' => $employee->emplTitle ?? new EmplTitle(['title_id' => 3]),
            'titles' => Title::all(),
            'address' => $employee->address,
            'birthdate' => $employee->birthdate,
            'phone' => $employee->phone,
            'email' => $employee->email,
            'sex' => $employee->sex,
            'baseEdu' => $employee->base_education,
            'qualification' => $employee->qualification,
            'orcid' => $employee->orcid_url,
            'scopus' => $employee->scopus_url,
            'mathnet' => $employee->mathnet_url,
            'clarivate' => $employee->clarivate_url,
            'bachelor_speciality' => $employee->bachelor_speciality,
            'master_speciality' => $employee->master_speciality,
            'specialist_speciality' => $employee->specialist_speciality,
            'phd_speciality' => $employee->phd_speciality,
            'bachelor_qualification' => $employee->bachelor_qualification,
            'master_qualification' => $employee->master_qualification,
            'specialist_qualification' => $employee->specialist_qualification,
            'phd_qualification' => $employee->phd_qualification
        ]);
    }


    public function markAsDeleted($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $employee->deleted = true;
            $employee->save();
        }

        return redirect()->route('empls.list')->with('success', 'Сотрудник помечен как удаленный.');
    }

    function restoreEmployee($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $employee->deleted = false;
            $employee->save();
        }

        return redirect()->route('empls.list')->with('success', 'Сотрудник восстановлен.');
    }

    function permanentDeleteEmpl($emplId)
    {
        EmplDegree::where('employee_id', $emplId)->delete();
        EmplTitle::where('employee_id', $emplId)->delete();
        EmplProfEducation::where('employee_id', $emplId)->delete();
        EmplContract::where('employee_id', $emplId)->delete();
        EmplPublication::where('empl_id', $emplId)->update(['empl_id' => 0]);
        Department::where('head_id', $emplId)->update(['head_id' => 0]);
        Employee::destroy($emplId);

        return redirect()->route('empls.list');
    }
}
