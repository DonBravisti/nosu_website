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
        $publs = Publication::all();
        $employees = Employee::all();
        $years = Publication::select('publication_year')->distinct()->pluck('publication_year');

        return view('publications', compact('publs', 'employees', 'years'));
    }

    function filter(Request $request)
    {
        $authors = $request->input('authors', []);
        // $years = $request->input('years', []);
        $start_year = $request->input('start_year');
        $end_year = $request->input('end_year');

        $query = Publication::query();

        if (!empty($authors)) {
            $query->whereHas('authors', function ($q) use ($authors) {
                $q->whereIn('employees.id', $authors);
            });
        }

        // if (!empty($years)) {
        //     $query->whereIn('publication_year', $years);
        // }

        if ($start_year) {
            $query->where('publication_year', '>=', $start_year);
        }

        if ($end_year) {
            $query->where('publication_year', '<=', $end_year);
        }

        $publs = $query->get();

        $employees = Employee::all();
        $years = Publication::select('publication_year')->distinct()->pluck('publication_year');

        return view('publications', compact('publs', 'employees', 'years'));
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
            'publ_levels.*' => 'required',
            'article_type' => 'required',
            'publication_year' => 'required'
        ]);

        $credentials = [
            'imprint' => $validate['imprint'],
            'publ_type_id' => $validate['article_type'],
            'publication_year' => $validate['publication_year'],
        ];

        $publication = Publication::create($credentials);
        $employees = Employee::find($validate['authors']);

        foreach ($employees as $employee) {
            $employee->publications()->attach($publication->id);
        }
        // $publication->employees()->attach($validate['authors']);
        $publication->publLevels()->attach($validate['publ_levels']);

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
            'publ_levels.*' => 'required',
            'article_type' => 'required',
            'publication_year' => 'required'
        ]);

        $credentials = [
            'imprint' => $validate['imprint'],
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

        $publ->publLevels()->sync($validate['publ_levels']);

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
