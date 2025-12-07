<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained()->onDelete('cascade');
            $table->foreignId('programme_id')->constrained();
            $table->string('application_number')->unique();
            $table->enum('status', [
                'draft',
                'submitted',
                'payment_pending',
                'under_review',
                'shortlisted',
                'admitted',
                'not_admitted'
            ])->default('draft');
            $table->text('notes')->nullable();
            $table->string('photo_path');
            $table->string('id_path');
            $table->string('recommendation_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('applications');
    }
};
