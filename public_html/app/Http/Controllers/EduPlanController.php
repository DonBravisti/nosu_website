<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Department;
use App\Models\EduPlan;
use App\Models\Speciality;
use App\Models\Subject;
use App\Models\TitlePlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class EduPlanController extends Controller
{
    function showPlans()
    {
        $plans = EduPlan::paginate(20);
        foreach ($plans as $plan) {
            $plan->fillFieldsNullValues();
        }

        return view('EduPlan.eduPlans', [
            'plans' => $plans,
        ]);
    }

    function showPlanAdd()
    {
        $blocks = Block::all()->sortBy('block_title');
        $subjects = Subject::all()->sortBy('title');
        $deps = Department::all()->sortBy('title');
        $titlePlans = TitlePlan::all();
        $specialities = Speciality::all()->sortBy('title');

        return view('EduPlan.eduPlanAdd', [
            'blocks' => $blocks,
            'subjects' => $subjects,
            'departments' => $deps,
            'titlePlans' => $titlePlans,
            'specs' => $specialities
        ]);
    }

    function addPlan(Request $request)
    {
        $request->flash();
        // $titlePlanFieldsExcluded = Rule::excludeIf($request['titlePlanId'] == 0);
        $validated = $request->validate([
            'blockId' => 'required',
            'subjectId' => 'required',
            'departmentId' => 'required',
            'codeSubject' => 'required',
            //Поля для title_plan
            'spec' => 'required',
            'profile' => 'required',
            'dateUchsovet' => 'required',
            'numberUchsovet' => 'required',
            'currentYear' => 'required',
            'dateEnter' => 'required',
            'dateFgos' => 'required',
            'numberFgos' => 'required',
            'included' => 'required'
        ]);

        $credentialsTitlePlan = [
            'spec_id' => $validated['spec'],
            'profile' => $validated['profile'],
            'date_uchsovet' =>$validated['dateUchsovet'],
            'number_uchsovet' => $validated['numberUchsovet'],
            'current_year' => $validated['currentYear'],
            'date_enter' => $validated['dateEnter'],
            'date_fgos' => $validated['dateFgos'],
            'number_fgos' => $validated['numberFgos'],
            'included' => $validated['included'],
            'department_id' => $validated['departmentId']
        ];

        $titlePlan = TitlePlan::create($credentialsTitlePlan);

        $credentialsEduPlan = [
            'block_id' => $validated['blockId'],
            'subject_id' => $validated['subjectId'],
            'code_subject' => $validated['codeSubject'],
            'department_id' => $validated['departmentId'],
            'title_plan_id' => $titlePlan->id
        ];

        if ($credentialsEduPlan['title_plan_id'] == '0') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            EduPlan::create($credentialsEduPlan);
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        } else {
            EduPlan::create($credentialsEduPlan);
        }

        session()->flash('success', 'План успешно добавлен!');
        return redirect()->route('edu-plan.add');
    }

    function showPlanUpdate($id) {
        
    }

    function deleteEduPlan($id) {
        EduPlan::destroy($id);

        return redirect(route('edu-plan.list'));
    }
}
