<?php

namespace App\Http\Controllers;

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
        $employees = DB::table('employees')->get();
        $degrees = DB::table('degrees')->get();
        $emplDegrees = DB::table('empl_degrees')->get();

        $emplFIOs = array();
        for ($i = 0; $i < count($employees); $i++) {
            $emplDegree = $this->getEmployeeDegree($employees[$i]->id, $emplDegrees, $degrees);
            $fio = sprintf('%s %s %s', $employees[$i]->surname, $employees[$i]->name, $employees[$i]->patronimyc);

            $emplFIOs[] = ['id' => $employees[$i]->id, 'fio' => $fio, 'degree' => $emplDegree];
        }

        return view('department', ['emplFIOs' => $emplFIOs]);
    }

    private function getEmployeeDegree($emplID, $emplDegrees, $degrees)
    {
        $degreeTableId = $emplDegrees->where('employee_id', $emplID)->value('degree_id') - 1;
        return $degrees[$degreeTableId]->title;
    }

    function goToPersonalCard($id)
    {
        $employee = Employee::all()->where('id', $id)->first();
        $degrees = DB::table('degrees')->get();
        $titles = DB::table('titles')->get();
        $emplDegrees = DB::table('empl_degrees')->get();
        // $emplDegree = $this->getEmployeeDegree($id, $emplDegrees, $degrees);
        $emplDegree = $degrees[$employee->emplDegree->degree_id - 1]->title;
        $emplTitle = $titles[$employee->emplTitle->title_id - 1]->title;

        return view('persCard', [
            'fio' => sprintf('%s %s %s', $employee->surname, $employee->name, $employee->patronimyc),
            'degree' => $emplDegree,
            'title' => $emplTitle
        ]);
    }

    function goToStructure()
    {
        return view('structure');
    }

    function goToContracts()
    {
        $contracts = EmplContract::all();
        $employees = Employee::all();
        $positions = Position::all();

        return view(
            'contracts',
            [
                'contracts' => $contracts,
                'employees' => $employees,
                'positions' => $positions
            ]
        );
    }

    function goToContractsAdd()
    {
        $employees = Employee::all();
        $positions = Position::all();

        $emplFIOs = array();
        foreach ($employees as $key => $empl) {
            $fio = sprintf('%s %s %s', $empl->surname, $empl->name, $empl->patronimyc);
            $emplFIOs[] = ['id' => $empl->id, 'fio' => $fio];
        }

        return view(
            'addContract',
            [
                'employees' => $emplFIOs,
                'positions' => $positions
            ]
        );
    }

    function addContract(Request $request)
    {
        $request->flash();
        $validate = $request->validate([
            'emplId' => 'required',
            'number' => 'required|int',
            'position_id' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            'competition' => 'required'
        ]);

        $credentials = [
            'employee_id' => $validate['emplId'],
            'date_from' => $validate['date_from'],
            'date_to' => $validate['date_to'],
            'number' => $validate['number'],
            'position_id' => $validate['position_id'],
            'competition' => $validate['competition']
        ];

        EmplContract::create($credentials);
        session()->flash('success', 'Успешно сохранено!');
        return redirect('/contracts');
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
            'author' => 'required',
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
        $employee = Employee::find($validate['author']);

        $emplPubl = new EmplPublication();
        $emplPubl->empl_id = $employee->id;
        $emplPubl->publ_id = $publication->id;
        $publication->emplPublication()->save($emplPubl);

        session()->flash('success', 'Успешно сохранено!');
        return redirect('/publs');
    }
}
