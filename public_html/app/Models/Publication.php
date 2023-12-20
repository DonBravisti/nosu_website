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
        'type'
    ];

    public function publLevel()
    {
        return $this->hasOne(PublLevel::class);
    }

    public function emplPublication()
    {
        return $this->hasMany(EmplPublication::class, 'publ_id');
    }
}
