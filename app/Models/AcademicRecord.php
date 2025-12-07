<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id', 'institution_name', 'qualification',
        'year_obtained', 'index_number', 'grades', 'certificate_path', 'level'
    ];

    protected $casts = [
        'grades' => 'array', // This will automatically encode/decode JSON
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
