<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\EduPlan;
use App\Models\Subject;
use Illuminate\Http\Request;

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
        $blocks = Block::all();
        return view('EduPlan.eduPlanAdd', [
            'blocks' => $blocks
        ]);
    }
}
