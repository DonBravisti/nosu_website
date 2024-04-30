<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublLevel extends Model
{
    use HasFactory;

    public function publications() {
        return $this->belongsToMany(Publication::class);
    }
}
