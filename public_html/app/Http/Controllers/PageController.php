<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\EmplContract;
use App\Models\EmplPublication;
use App\Models\Position;
use App\Models\Publication;
use App\Models\PublLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    function goToDepartment()
    {
        $department = Department::where('title', 'Кафедра прикладной математики и информатики')->first();
        if (!$department) {
            abort(404, 'Кафедра не найдена.');
        }

        $employees = EmplContract::where('department_id', $department->id)
            ->with('employee.emplDegrees.degree')
            ->get()
            ->map(function ($contract) {
                $employee = $contract->employee;
                $degree = $employee->emplDegrees->first()?->degree->title ?? 'Без ученой степени';

                return [
                    'id' => $employee->id,
                    'fio' => "{$employee->surname} {$employee->name} {$employee->patronimyc}",
                    'degree' => $degree,
                ];
            });

        return view('departments.department', [
            'employees' => $employees
        ]);

        // $employees = DB::table('employees')->get();
        // $degrees = DB::table('degrees')->get();
        // $emplDegrees = DB::table('empl_degrees')->get();

        // $emplFIOs = array();
        // for ($i = 0; $i < count($employees); $i++) {
        //     $emplDegree = $this->getEmployeeDegree($employees[$i]->id, $emplDegrees, $degrees);
        //     $fio = sprintf('%s %s %s', $employees[$i]->surname, $employees[$i]->name, $employees[$i]->patronimyc);

        //     $emplFIOs[] = ['id' => $employees[$i]->id, 'fio' => $fio, 'degree' => $emplDegree];
        // }

        // return view('department', ['emplFIOs' => $emplFIOs]);
    }

    public function departmentAlgebraAnalysis()
    {
        $department = Department::where('title', 'Кафедра алгебры и анализа')->first();
        if (!$department) {
            abort(404, 'Кафедра не найдена.');
        }

        $employees = EmplContract::where('department_id', $department->id)
            ->with('employee.emplDegrees.degree')
            ->get()
            ->map(function ($contract) {
                $employee = $contract->employee;
                $degree = $employee->emplDegrees->first()?->degree->title ?? 'Без ученой степени';

                return [
                    'id' => $employee->id,
                    'fio' => "{$employee->surname} {$employee->name} {$employee->patronimyc}",
                    'degree' => $degree,
                ];
            });

        return view('departments.department_algebra_analysis', [
            'employees' => $employees,
        ]);
    }


    private function getEmployeeDegree($emplID, $emplDegrees, $degrees)
    {
        $degreeTableId = $emplDegrees->where('employee_id', $emplID)->value('degree_id') - 1;
        return $degrees[$degreeTableId]->title;
    }

    function goToPersonalCard($id)
    {
        $employee = Employee::with(['emplDegrees.degree', 'emplTitle.title'])->findOrFail($id);

        $emplDegree = $employee->emplDegrees->first();
        $degreeTitle = $emplDegree && $emplDegree->degree ? $emplDegree->degree->title : 'Степень не указана';

        $emplTitle = $employee->emplTitle;
        $titleTitle = $emplTitle && $emplTitle->title ? $emplTitle->title->title : 'Звание не указано';

        return view('employees.persCard', [
            'fio' => sprintf('%s %s %s', $employee->surname, $employee->name, $employee->patronimyc),
            'degree' => $degreeTitle,
            'title' => $titleTitle
        ]);
    }


    function goToStructure()
    {
        return view('departments.structure');
    }







    function goToPublications()
    {
        $publications = Publication::all();

        return view('publications', [
            'publs' => $publications,

        ]);
    }

    function goToPublsAdd()
    {
        $publLevels = PublLevel::all();
        $employees = Employee::all();
        return view('publsAdd', [
            'publLevels' => $publLevels,
            'employees' => $employees
        ]);
    }

    function addPubl(Request $request)
    {
        $request->flash();
        $validate = $request->validate([
            'authors.*' => 'required',
            'title' => 'required',
            'DOI' => 'required',
            'imprint' => 'required',
            'publ_level' => 'required',
            'article_type' => 'required'
        ]);

        $credentials = [
            'title' => $validate['title'],
            'DOI' => $validate['DOI'],
            'imprint' => $validate['imprint'],
            'publ_level_id' => $validate['publ_level'],
            'type' => $validate['article_type']
        ];

        $publication = Publication::create($credentials);
        $employees = Employee::find($validate['authors']);
        // echo $employees;
        // print_r($validate['authors']);

        foreach ($employees as $employee) {
            $emplPubl = new EmplPublication();
            $emplPubl->empl_id = $employee->id;
            $emplPubl->publ_id = $publication->id;
            $publication->emplPublication()->save($emplPubl);
        }


        session()->flash('success', 'публикация успешно добавлена!');
        return redirect()->route('publs.list');
    }
}
