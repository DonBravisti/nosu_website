<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;

class EduPlan extends Model
{
    use HasFactory;

    protected $table = 'edu_plan';
    protected $fillable = [
        'block_id',
        'subject_id',
        'code_subject',
        'department_id',
        'title_plan_id'
    ];

    function block()
    {
        return $this->belongsTo(Block::class);
    }

    function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    function department()
    {
        return $this->belongsTo(Department::class);
    }

    function titlePlan()
    {
        return $this->belongsTo(TitlePlan::class);
    }

    function fillFieldsNullValues()
    {
        $this->subject = $this->subject ?: new Subject(['title' => 'Предмет не указан']);
        $this->block = $this->block ?: new Block(['title' => 'Блок не указан']);
        $this->department = $this->department ?: new Department(['title' => 'Кафедра не указана']);
    }
}
