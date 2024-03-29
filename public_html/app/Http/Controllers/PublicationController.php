<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmplPublication;
use App\Models\Publication;
use App\Models\PublLevel;
use App\Models\PublType;

class PublicationController extends Controller
{
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
        $publTypes = PublType::all();

        return view('publsAdd', compact('publLevels', 'employees', 'publTypes'));
    }

    function addPubl(Request $request)
    {
        $request->flash();
        $validate = $request->validate([
            'authors.*' => 'required',
            'imprint' => 'required',
            'publ_level' => 'required',
            'article_type' => 'required',
            'publication_year' => 'required'
        ]);

        $credentials = [
            'imprint' => $validate['imprint'],
            'publ_level_id' => $validate['publ_level'],
            'publ_type_id' => $validate['article_type'],
            'publication_year' => $validate['publication_year'],
        ];

        $publication = Publication::create($credentials);
        $employees = Employee::find($validate['authors']);

        foreach ($employees as $employee) {
            $employee->publications()->attach($publication->id);
            // $emplPubl = new EmplPublication();
            // $emplPubl->empl_id = $employee->id;
            // $emplPubl->publ_id = $publication->id;
            // $publication->emplPublication()->save($emplPubl);
        }


        session()->flash('success', 'публикация успешно добавлена!');
        return redirect()->route('publs.list');
    }

    function showPublUpdate($id)
    {
        $publ = Publication::find($id);
        $employees = Employee::all();
        $publLevels = PublLevel::all();
        $publTypes = PublType::all();

        return view('publEdit', compact('publ', 'employees', 'publLevels', 'publTypes'));
    }

    function updatePubl(Request $request, $id)
    {
        $validate = $request->validate([
            'authors.*' => 'required',
            'imprint' => 'required',
            'publ_level' => 'required',
            'article_type' => 'required',
            'publication_year' => 'required'
        ]);

        $credentials = [
            'imprint' => $validate['imprint'],
            'publ_level_id' => $validate['publ_level'],
            'publ_type_id' => $validate['article_type'],
            'publication_year' => $validate['publication_year'],
        ];

        $publ = Publication::find($id);
        $publ->update($credentials);

        $employeesNew = Employee::find($validate['authors']);
        $employeesOld = $publ->authors;

        foreach ($employeesOld as $employee) {
            $employee->publications()->detach($publ->id);
        }

        foreach ($employeesNew as $employee) {
            $employee->publications()->attach($publ->id);
        }

        session()->flash('success', 'публикация успешно обновлена!');
        return redirect()->route('publs.list');
    }

    function removePubl($id)
    {
        EmplPublication::where('publ_id', $id)->delete();
        Publication::destroy($id);

        return redirect()->route('publs.list');
    }
}
