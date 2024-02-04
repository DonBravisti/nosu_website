<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmplProfEducation;
use App\Models\ProfDocType;
use Illuminate\Http\Request;

class SpkController extends Controller
{
    function goToSpkList () {
        $spk = EmplProfEducation::all();
        return view('spk', ['spk' => $spk]);
    }

    function goToSpkAdd() {
        $empls = Employee::all();
        $docTypes = ProfDocType::all();
        return view('spkAdd', ['empls' => $empls, 'docTypes' => $docTypes]);
    }

    function addSpk(Request $request) {
        $request->flash();
        $validated = $request->validate([
            'emplId'=>'required',
            'sertNum'=>'required',
            'givenDate'=>'required',
            'docTypeId'=>'required',
            'sertTitle'=>'required',
            'nHours'=>'required',
            'organization'=>'required'
        ]);

        $credentials = [
            'employee_id'=>$validated['emplId'],
            'number'=>$validated['sertNum'],
            'date'=>$validated['givenDate'],
            'doc_type_id'=>$validated['docTypeId'],
            'title'=>$validated['sertTitle'],
            'n_hours'=>$validated['nHours'],
            'organization'=>$validated['organization']
        ];

        EmplProfEducation::create($credentials);
        session()->flash('success', 'Успешно добавлено');
        return redirect(route('spk.add'));
    }

    function removeSpk($id) {
        EmplProfEducation::destroy($id);

        return redirect(route('spk.list'));
    }
}
