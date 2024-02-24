<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmplContractType extends Model
{
    use HasFactory;

    public function emplContract()
    {
        return $this->hasOne(EmplContract::class);
    }
}
