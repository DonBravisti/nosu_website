<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $table = 'block';
    protected $fillable = [
        'title'
    ];

    function eduPlan()
    {
        $this->hasOne(EduPlan::class);
    }
}
