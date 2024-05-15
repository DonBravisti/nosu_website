<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    function eduPlan()
    {
        return $this->hasOne(EduPlan::class);
    }

    function titlePlan()
    {
        return $this->hasOne(TitlePlan::class, 'title_plan');
    }

    function emplContracts()
    {
        return $this->hasMany(EmplContract::class);
    }
}
