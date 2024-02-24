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
        'orcid_url',
        'scopus_url',
        'mathnet_url',
        'clarivate_url'
    ];

    public function FIO()
    {
        $fio = $fio = sprintf('%s %s %s', $this->surname, $this->name, $this->patronimyc);

        return $fio;
    }

    function emplContract() {
        return $this->hasOne(EmplContract::class);
    }

    public function emplDegree()
    {
        return $this->hasOne(EmplDegree::class);
    }

    public function emplTitle()
    {
        return $this->hasOne(EmplTitle::class);
    }

    public function emplPublication()
    {
        return $this->hasOne(EmplPublication::class);
    }

    public function profEducation()
    {
        return $this->hasMany(EmplProfEducation::class);
    }
}
