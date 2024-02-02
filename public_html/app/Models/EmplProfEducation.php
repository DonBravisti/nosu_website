<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProfDocType;

class EmplProfEducation extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function profDocType()
    {
        return $this->belongsTo(ProfDocType::class, 'doc_type_id');
    }
}
