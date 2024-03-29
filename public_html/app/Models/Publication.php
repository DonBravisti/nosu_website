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

    public function publLevel()
    {
        return $this->belongsTo(PublLevel::class);
    }

    // public function emplPublication()
    // {
    //     return $this->hasMany(EmplPublication::class, 'publ_id');
    // }

    public function authors()
    {
        return $this->belongsToMany(Employee::class, 'empl_publications', 'publ_id', 'empl_id');
    }
}
