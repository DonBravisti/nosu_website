<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'DOI',
        'imprint',
        'publ_level_id',
        'type',
        'publication_year'
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'empl_publications', 'empl_id', 'publ_id');
    }


    public function publLevels()
    {
        return $this->belongsToMany(PublLevel::class, 'publication_publ_level');
    }

    public function authors()
    {
        return $this->belongsToMany(Employee::class, 'empl_publications', 'publ_id', 'empl_id');
    }
}
