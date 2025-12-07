<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('academic_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained()->onDelete('cascade');
            $table->string('institution_name');
            $table->string('qualification');
            $table->year('year_obtained');
            $table->string('index_number')->nullable();
            $table->json('grades');
            $table->string('certificate_path');
            $table->enum('level', ['o_level', 'a_level', 'diploma', 'degree', 'other']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('academic_records');
    }
};
