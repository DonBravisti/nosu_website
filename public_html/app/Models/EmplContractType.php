<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmplContractType extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function emplContract()
    {
        return $this->hasOne(EmplContract::class, 'empl_contract_type');
    }
}
