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
    // function showPlans()
    // {
    //     $plans = EduPlan::paginate(20);
    //     foreach ($plans as $plan) {
    //         $plan->fillFieldsNullValues();
    //     }

    //     return view('edu_plan.eduPlans', [
    //         'plans' => $plans,
    //     ]);
    // }

    // function showPlanAdd()
    // {
    //     $blocks = Block::all()->sortBy('block_title');
    //     $subjects = Subject::all()->sortBy('title');
    //     $deps = Department::all()->sortBy('title');
    //     $titlePlans = TitlePlan::all();
    //     $specialities = Speciality::all()->sortBy('title');

    //     return view('edu_plan.eduPlanAdd', [
    //         'blocks' => $blocks,
    //         'subjects' => $subjects,
    //         'departments' => $deps,
    //         'titlePlans' => $titlePlans,
    //         'specs' => $specialities
    //     ]);
    // }

    // function addPlan(Request $request)
    // {
    //     $request->flash();
    //     // $titlePlanFieldsExcluded = Rule::excludeIf($request['titlePlanId'] == 0);
    //     $validated = $request->validate([
    //         'blockId' => 'required',
    //         'subjectId' => 'required',
    //         'departmentId' => 'required',
    //         'codeSubject' => 'required',
    //         //Поля для title_plan
    //         'spec' => 'required',
    //         'profile' => 'required',
    //         'dateUchsovet' => 'required',
    //         'numberUchsovet' => 'required',
    //         'currentYear' => 'required',
    //         'dateEnter' => 'required',
    //         'dateFgos' => 'required',
    //         'numberFgos' => 'required',
    //         'included' => 'required'
    //     ]);

    //     $credentialsTitlePlan = [
    //         'spec_id' => $validated['spec'],
    //         'profile' => $validated['profile'],
    //         'date_uchsovet' => $validated['dateUchsovet'],
    //         'number_uchsovet' => $validated['numberUchsovet'],
    //         'current_year' => $validated['currentYear'],
    //         'date_enter' => $validated['dateEnter'],
    //         'date_fgos' => $validated['dateFgos'],
    //         'number_fgos' => $validated['numberFgos'],
    //         'included' => $validated['included'],
    //         'department_id' => $validated['departmentId']
    //     ];

    //     $titlePlan = TitlePlan::create($credentialsTitlePlan);

    //     $credentialsEduPlan = [
    //         'block_id' => $validated['blockId'],
    //         'subject_id' => $validated['subjectId'],
    //         'code_subject' => $validated['codeSubject'],
    //         'department_id' => $validated['departmentId'],
    //         'title_plan_id' => $titlePlan->id
    //     ];

    //     if ($credentialsEduPlan['title_plan_id'] == '0') {
    //         DB::statement('SET FOREIGN_KEY_CHECKS=0');
    //         EduPlan::create($credentialsEduPlan);
    //         DB::statement('SET FOREIGN_KEY_CHECKS=1');
    //     } else {
    //         EduPlan::create($credentialsEduPlan);
    //     }

    //     session()->flash('success', 'План успешно добавлен!');
    //     return redirect()->route('edu-plan.add');
    // }

    // function showPlanUpdate($id)
    // {
    //     $blocks = Block::all()->sortBy('block_title');
    //     $subjects = Subject::all()->sortBy('title');
    //     $deps = Department::all()->sortBy('title');
    //     $specialities = Speciality::all()->sortBy('title');

    //     $eduPlan = EduPlan::find($id);
    //     $eduPlan->fillFieldsNullValues();
    //     $titlePlan = $eduPlan->titlePlan;

    //     return view('edu_plan.eduPlanEdit', [
    //         'blocks' => $blocks,
    //         'subjects' => $subjects,
    //         'departments' => $deps,
    //         'eduPlan' => $eduPlan,
    //         'specs' => $specialities,
    //         'titlePlan' => $titlePlan
    //     ]);
    // }

    // function updatePlan($id)
    // {
    //     $validated = request()->validate([
    //         'blockId' => 'required',
    //         'subjectId' => 'required',
    //         'departmentId' => 'required',
    //         'codeSubject' => 'required',
    //         //Поля для title_plan
    //         'spec' => 'required',
    //         'profile' => 'required',
    //         'dateUchsovet' => 'required',
    //         'numberUchsovet' => 'required',
    //         'currentYear' => 'required',
    //         'dateEnter' => 'required',
    //         'dateFgos' => 'required',
    //         'numberFgos' => 'required',
    //         'included' => 'required'
    //     ]);

    //     $eduPlan = EduPlan::findOrFail($id);
    //     $titlePlan = $eduPlan->titlePlan;

    //     $credentialsTitlePlan = [
    //         'spec_id' => $validated['spec'],
    //         'profile' => $validated['profile'],
    //         'date_uchsovet' => $validated['dateUchsovet'],
    //         'number_uchsovet' => $validated['numberUchsovet'],
    //         'current_year' => $validated['currentYear'],
    //         'date_enter' => $validated['dateEnter'],
    //         'date_fgos' => $validated['dateFgos'],
    //         'number_fgos' => $validated['numberFgos'],
    //         'included' => $validated['included'],
    //         'department_id' => $validated['departmentId']
    //     ];

    //     $credentialsEduPlan = [
    //         'block_id' => $validated['blockId'],
    //         'subject_id' => $validated['subjectId'],
    //         'code_subject' => $validated['codeSubject'],
    //         'department_id' => $validated['departmentId']
    //     ];

    //     $eduPlan->update($credentialsEduPlan);
    //     $titlePlan->update($credentialsTitlePlan);

    //     session()->flash('success', 'Успешно обновлено!');
    //     return redirect()->back();
    // }

    function deleteEduPlan($id)
    {
        EduPlan::destroy($id);

        return redirect(route('edu-plan.list'));
    }

    function showSpecialities()
    {
        $specialities = Speciality::all();
        return view('edu_plan.specialities', compact('specialities'));
    }

    function showTitles($specialityId)
    {
        $speciality = Speciality::findOrFail($specialityId);
        $titles = TitlePlan::where('spec_id', $specialityId)->get();

        return view('edu_plan.titles', compact('speciality', 'titles'));
    }

    function showPlans($titleId)
    {
        $title = TitlePlan::with('speciality')->findOrFail($titleId);
        $plans = EduPlan::with(['subject', 'department', 'block'])
            ->where('title_plan_id', $titleId)
            ->get();

        return view('edu_plan.plans', compact('title', 'plans'));
    }

    public function showTitleCreate($specialityId)
    {
        $speciality = Speciality::findOrFail($specialityId);
        return view('edu_plan.title_form', compact('speciality'));
    }

    public function storeTitle(Request $request, $specialityId)
    {
        $validated = $request->validate([
            'profile' => 'required|string|max:255',
            'date_enter' => 'required|digits:4',
            'current_year' => 'required|digits:4',
            'date_uchsovet' => 'required|date',
            'number_uchsovet' => 'required|integer',
            'date_fgos' => 'required|date',
            'number_fgos' => 'required|integer',
            'included' => 'required|boolean',
        ]);

        $validated['spec_id'] = $specialityId;
        TitlePlan::create($validated);

        return redirect()->route('edu-plan.titles', $specialityId)->with('success', 'Титул создан');
    }

    public function showTitleEdit($titleId)
    {
        $title = TitlePlan::findOrFail($titleId);
        $speciality = $title->speciality;

        return view('edu_plan.title_form', compact('title', 'speciality'));
    }

    public function updateTitle(Request $request, $titleId)
    {
        $validated = $request->validate([
            'profile' => 'required|string|max:255',
            'date_enter' => 'required|digits:4',
            'current_year' => 'required|digits:4',
            'date_uchsovet' => 'required|date',
            'number_uchsovet' => 'required|integer',
            'date_fgos' => 'required|date',
            'number_fgos' => 'required|integer',
            'included' => 'required|boolean',
        ]);

        $title = TitlePlan::findOrFail($titleId);
        $title->update($validated);

        return redirect()->route('edu-plan.titles', $title->spec_id)->with('success', 'Титул обновлен');
    }

    public function showPlanCreate($titleId)
    {
        $title = TitlePlan::with('speciality')->findOrFail($titleId);
        $blocks = Block::all()->sortBy('block_title');
        $subjects = Subject::all()->sortBy('title');
        $departments = Department::all()->sortBy('title');

        return view('edu_plan.plan_form', compact('title', 'blocks', 'subjects', 'departments'));
    }

    public function storePlan(Request $request, $titleId)
    {
        $validated = $request->validate([
            'block_id' => 'required|exists:block,id',
            'subject_id' => 'required|exists:subjects,id',
            'department_id' => 'required|exists:departments,id',
            'code_subject' => 'required|string|max:255',
        ]);

        $validated['title_plan_id'] = $titleId;
        EduPlan::create($validated);

        return redirect()->route('edu-plan.plans', $titleId)->with('success', 'Учебный план создан');
    }

    public function showPlanEdit($planId)
    {
        $plan = EduPlan::with('titlePlan.speciality')->findOrFail($planId);
        $blocks = Block::all()->sortBy('block_title');
        $subjects = Subject::all()->sortBy('title');
        $departments = Department::all()->sortBy('title');

        return view('edu_plan.plan_form', compact('plan', 'blocks', 'subjects', 'departments'));
    }

    public function updatePlan(Request $request, $planId)
    {
        $validated = $request->validate([
            'block_id' => 'required|exists:block,id',
            'subject_id' => 'required|exists:subjects,id',
            'department_id' => 'required|exists:departments,id',
            'code_subject' => 'required|string|max:255',
        ]);

        $plan = EduPlan::findOrFail($planId);
        $plan->update($validated);

        return redirect()->route('edu-plan.plans', $plan->title_plan_id)->with('success', 'Учебный план обновлен');
    }

    public function deleteTitle($titleId)
    {
        $title = TitlePlan::findOrFail($titleId);

        // Удалим сначала планы, связанные с титулом
        EduPlan::where('title_plan_id', $titleId)->delete();

        $title->delete();

        return redirect()->route('edu-plan.titles', $title->spec_id)
            ->with('success', 'Титул и связанные с ним планы удалены');
    }

    public function deletePlan($planId)
    {
        $plan = EduPlan::findOrFail($planId);
        $titleId = $plan->title_plan_id;

        $plan->delete();

        return redirect()->route('edu-plan.plans', $titleId)
            ->with('success', 'Учебный план удалён');
    }
}
