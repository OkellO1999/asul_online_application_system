<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Programme;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'ASUL Admin',
            'email' => 'admin@asul.ac.ug',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create registrar user
        User::create([
            'name' => 'Academic Registrar',
            'email' => 'registrar@asul.ac.ug',
            'password' => Hash::make('password'),
            'role' => 'registrar',
        ]);

        // Create sample programmes
        Programme::create([
            'name' => 'Bachelor of Medicine and Surgery',
            'code' => 'MBChB',
            'duration' => 5,
            'requirements' => 'Two principal passes in Biology and Chemistry at A-Level',
            'application_fee' => 50000,
        ]);

        Programme::create([
            'name' => 'Bachelor of Education',
            'code' => 'BED',
            'duration' => 3,
            'requirements' => 'Two principal passes at A-Level in relevant subjects',
            'application_fee' => 30000,
        ]);

        Programme::create([
            'name' => 'Bachelor of Business Administration',
            'code' => 'BBA',
            'duration' => 3,
            'requirements' => 'Two principal passes at A-Level',
            'application_fee' => 40000,
        ]);
    }
}
