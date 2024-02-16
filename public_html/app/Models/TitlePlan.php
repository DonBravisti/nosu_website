<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitlePlan extends Model
{
    use HasFactory;

    protected $table = 'title_plan';
    protected $fillable = [
        'spec_id',
        'profile',
        'date_uchsovet',
        'number_uchsovet',
        'current_year',
        'date_enter',
        'date_fgos',
        'number_fgos',
        'included',
        'department_id'
    ];

    function eduPlan()
    {
        return $this->hasOne(EduPlan::class);
    }

    function department()
    {
        return $this->belongsTo(Department::class);
    }

    function speciality()
    {
        return $this->belongsTo(Speciality::class, 'spec_id');
    }
}
