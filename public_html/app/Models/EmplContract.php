<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

class EmplContract extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'date_from',
        'date_to',
        'number',
        'position_id',
        'empl_contract_type',
        'department_id'
    ];

    function fillFieldsNullValues()
    {
        $this->emplContractType = $this->emplContractType ?: new EmplContractType(['title' => 'Не указано']);
        $this->department = $this->department ?: new Department(['title' => 'Не указано']);
    }

    function position()
    {
        return $this->belongsTo(Position::class);
    }

    function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function emplContractType()
    {
        return $this->belongsTo(EmplContractType::class, 'empl_contract_type');
    }
}
