<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmplContract extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'date_from',
        'date_to',
        'number',
        'position_id',
        'competition'
    ];
}
