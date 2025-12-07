<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'duration', 'requirements', 'application_fee', 'is_active'
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
