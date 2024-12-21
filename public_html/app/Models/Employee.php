<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmplDegree;
use App\Models\EmplTitle;

class Employee extends Model
{
    use HasFactory;

    protected $dates = ['birthdate'];
    protected $fillable = [
        'surname',
        'name',
        'patronimyc',
        'address',
        'birthdate',
        'sex',
        'phone',
        'email',
        'base_education',
        'qualification',
        'bachelor_speciality',
        'master_speciality',
        'specialist_speciality',
        'phd_speciality',
        'bachelor_qualification',
        'master_qualification',
        'specialist_qualification',
        'phd_qualification',
        'orcid_url',
        'scopus_url',
        'mathnet_url',
        'clarivate_url'
    ];

    public function getFioAttribute()
    {
        return sprintf('%s %s %s', $this->surname, $this->name, $this->patronimyc);
    }

    public function FIO()
    {
        $fio = $fio = sprintf('%s %s %s', $this->surname, $this->name, $this->patronimyc);

        return $fio;
    }

    function emplContract()
    {
        return $this->hasOne(EmplContract::class);
    }

    public function emplDegrees()
    {
        return $this->hasMany(EmplDegree::class,);
    }


    public function emplTitle()
    {
        return $this->hasOne(EmplTitle::class);
    }

    // public function emplPublication()
    // {
    //     return $this->hasOne(EmplPublication::class);
    // }

    public function publications()
    {
        return $this->belongsToMany(Publication::class, 'empl_publications', 'empl_id', 'publ_id');
    }

    public function profEducation()
    {
        return $this->hasMany(EmplProfEducation::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'empl_contracts', 'employee_id', 'department_id');
    }
}
