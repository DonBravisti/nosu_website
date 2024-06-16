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

    public function filter(Request $request) {
        $author = $request->input('author');
        $start_year = $request->input('start_year');
        $end_year = $request->input('end_year');
        $sort_by = $request->input('sort_by', 'publication_year');
        $sort_order = $request->input('sort_order', 'asc');

        $query = Publication::query();

        // Фильтрация по автору
        if ($author) {
            $query->whereHas('authors', function($q) use ($author) {
                $q->where('surname', 'like', "%$author%")
                  ->orWhere('name', 'like', "%$author%")
                  ->orWhere('patronimyc', 'like', "%$author%");
            });
        }

        // Фильтрация по началу периода
        if ($start_year) {
            $query->where('publication_year', '>=', $start_year);
        }

        // Фильтрация по концу периода
        if ($end_year) {
            $query->where('publication_year', '<=', $end_year);
        }

        // Сортировка
        if ($sort_by == 'authors') {
            $query->with(['authors' => function($q) use ($sort_order) {
                $q->orderBy('surname', $sort_order)->orderBy('name', $sort_order)->orderBy('patronimyc', $sort_order);
            }]);
        } else {
            $query->orderBy($sort_by, $sort_order);
        }

        $publs = $query->with(['authors', 'publLevels'])->get();

        if ($request->ajax()) {
            return response()->json(['publs' => $publs]);
        }

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
