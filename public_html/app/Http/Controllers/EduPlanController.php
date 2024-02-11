<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Department;
use App\Models\EduPlan;
use App\Models\Subject;
use App\Models\TitlePlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('EduPlan.eduPlanAdd', [
            'blocks' => $blocks,
            'subjects' => $subjects,
            'departments' => $deps,
            'titlePlans' => $titlePlans
        ]);
    }

    function addPlan(Request $request)
    {
        $validated = $request->validate([
            'blockId' => 'required',
            'subjectId' => 'required',
            'departmentId' => 'required',
            'codeSubject' => 'required',
            'titlePlanId' => 'required'
        ]);

        $credentials = [
            'block_id' => $validated['blockId'],
            'subject_id' => $validated['subjectId'],
            'code_subject' => $validated['codeSubject'],
            'department_id' => $validated['departmentId'],
            'title_plan_id' => $validated['titlePlanId']
        ];

        if ($credentials['title_plan_id'] == '0') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            EduPlan::create($credentials);
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        } else {
            EduPlan::create($credentials);
        }

        session()->flash('success', 'План успешно добавлен!');
        return redirect()->route('edu-plan.add');
    }
}
