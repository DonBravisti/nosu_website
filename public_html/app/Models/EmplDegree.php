<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Degree;

class EmplDegree extends Model
{
    use HasFactory;

    protected $fillable = [
        'spec_id'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }
}
