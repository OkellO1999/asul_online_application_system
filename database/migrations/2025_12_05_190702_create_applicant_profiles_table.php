
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantProfilesTable extends Migration
{
    public function up()
    {
        Schema::create('applicant_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('nationality');
            $table->string('contact_phone');
            $table->text('address');
            $table->string('country');
            $table->string('district')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('id_path')->nullable(); // National ID or Passport
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('applicant_profiles');
    }
}
