<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstName');
            $table->string('middleName')->nullable();
            $table->string('lastName');
            $table->enum('pronouns', ['He/Him/His', 'She/Her/Hers', 'They/Them/Theirs']);
            $table->string('nameWhileAttending')->nullable();
            $table->string('alumniEmail');
            $table->enum('affiliation', ['Alumni', 'Student', 'Friend']);
            $table->integer('gradYear')->nullable();
            $table->string('degreeType')->nullable();
            $table->string('major')->nullable();
            $table->enum('beachFamilyMember', ['child', 'parent', 'relative'])->nullable();
            $table->string('beachName')->nullable();
            $table->string('homePhone')->nullable();
            $table->string('cellPhone');
            $table->string('streetAddressOne');
            $table->string('streetAddressTwo')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('country')->nullable();
            $table->string('linkedInProfile')->nullable();
            $table->string('facebookProfile')->nullable();
            $table->string('twitterProfile')->nullable();
            $table->string('instagramProfile')->nullable();
            $table->string('membershipToken');
            $table->string('businessEmployer')->nullable();
            $table->string('jobTitle')->nullable();
            $table->string('businessPhoneNumber')->nullable();
            $table->string('businessEmail')->nullable();
            $table->string('businessAddress')->nullable();
            $table->string('opportunities')->nullable();
            $table->string('digitalCardLink')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumni');
    }
};
