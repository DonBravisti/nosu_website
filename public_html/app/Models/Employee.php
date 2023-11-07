<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmplDegree;
use App\Models\EmplTitle;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'surname',
        'name',
        'patronimyc',
    ];

    public function emplDegree() {
        return $this->hasOne(EmplDegree::class);
    }

    public function emplTitle() {
        return $this->hasOne(EmplTitle::class);
    }
}
