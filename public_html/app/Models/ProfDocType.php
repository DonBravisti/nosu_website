<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfDocType extends Model
{
    use HasFactory;

    public function profEducation()
    {
        return $this->hasOne(EmplProfEducation::class, 'doc_type_id');
    }
}
