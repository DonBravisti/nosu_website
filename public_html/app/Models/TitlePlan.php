<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitlePlan extends Model
{
    use HasFactory;

    protected $table = 'title_plan';
    protected $fillable = [
        'title'
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
