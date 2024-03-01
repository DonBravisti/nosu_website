<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmplProfEducation;
use App\Models\ProfDocType;
use Illuminate\Http\Request;

class SpkController extends Controller
{
    function showFpkEmplsList()
    {
        $employees = Employee::all();

        return view('FPK.FpkEmployees', compact('employees'));
    }

    function showFpkEmployee($id)
    {
        $empl = Employee::findOrFail($id);
        $fpk = EmplProfEducation::all()->where('employee_id', $id);

        return view('FPK.fpk', compact('empl', 'fpk'));
    }

    function goToSpkAdd()
    {
        $empls = Employee::all();
        $docTypes = ProfDocType::all();
        return view('FPK.fpkAdd', ['empls' => $empls, 'docTypes' => $docTypes]);
    }

    function addSpk(Request $request)
    {
        $request->flash();
        $validated = $request->validate([
            'emplId' => 'required',
            'sertNum' => 'required',
            'givenDate' => 'required',
            'docTypeId' => 'required',
            'sertTitle' => 'required',
            'nHours' => 'required',
            'organization' => 'required',
            'image' => 'nullable'
        ]);

        $credentials = [
            'employee_id' => $validated['emplId'],
            'number' => $validated['sertNum'],
            'date' => $validated['givenDate'],
            'doc_type_id' => $validated['docTypeId'],
            'title' => $validated['sertTitle'],
            'n_hours' => $validated['nHours'],
            'organization' => $validated['organization']
        ];

        $fpk = EmplProfEducation::create($credentials);

        $imgPath = ImageController::uploadImage(
            $request->file('image'),
            $validated['emplId'],
            $fpk->id
        );

        session()->flash('success', 'Успешно добавлено');
        return redirect(route('fpk.add', compact('imgPath')));
    }

    function showSpkUpdate($id)
    {
        $empls = Employee::all();
        $docTypes = ProfDocType::all();

        $sertificate = EmplProfEducation::findOrFail($id);

        return view('FPK.FpkEdit', ['empls' => $empls, 'docTypes' => $docTypes, 'sertificate' => $sertificate]);
    }

    function updateSpk(Request $request, $id)
    {
        $validated = $request->validate([
            'emplId' => 'required',
            'sertNum' => 'required',
            'givenDate' => 'required',
            'docTypeId' => 'required',
            'sertTitle' => 'required',
            'nHours' => 'required',
            'organization' => 'required'
        ]);

        $credentials = [
            'employee_id' => $validated['emplId'],
            'number' => $validated['sertNum'],
            'date' => $validated['givenDate'],
            'doc_type_id' => $validated['docTypeId'],
            'title' => $validated['sertTitle'],
            'n_hours' => $validated['nHours'],
            'organization' => $validated['organization']
        ];

        $sertificate = EmplProfEducation::findOrFail($id);
        $sertificate->update($credentials);

        session()->flash('success', 'Успешно обновлено!');
        return redirect()->back();
    }

    function removeSpk($id)
    {
        EmplProfEducation::destroy($id);

        return redirect(route('fpk.list'));
    }
}
