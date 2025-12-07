<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id', 'programme_id', 'application_number',
        'status', 'notes', 'photo_path', 'id_path', 'recommendation_path'
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function programme()
    {
        return $this->belongsTo(Programme::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($application) {
            $application->application_number = 'ASUL-' . date('Y') . '-' . str_pad(static::count() + 1, 5, '0', STR_PAD_LEFT);
        });
    }
}
