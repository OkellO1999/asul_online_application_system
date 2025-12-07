<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'date_of_birth', 'gender', 'nationality',
        'country', 'district', 'address', 'emergency_contact_name',
        'emergency_contact_phone', 'emergency_contact_relationship'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function academicRecords()
    {
        return $this->hasMany(AcademicRecord::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
