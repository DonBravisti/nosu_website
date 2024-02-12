<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;

    protected $table = 'speciality';

    function titlePlan()
    {
        return $this->hasOne(TitlePlan::class, 'spec_id');
    }
}
