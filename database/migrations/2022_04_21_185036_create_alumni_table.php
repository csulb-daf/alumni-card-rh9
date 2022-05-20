<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumniTable extends Migration
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
            $table->string('middleName');
            $table->string('lastName');
            $table->enum('pronouns', ['He/Him/His', 'She/Her/Hers', 'They/Them/Theirs']);
            $table->string('nameWhileAttending');
            $table->string('email');
            $table->enum('affiliation', ['Alumni', 'Student', 'Friend']);
            $table->integer('gradYear');
            $table->string('degreeType');
            $table->string('major');
            $table->enum('beachFamilyMember', ['child', 'parent', 'relative']);
            $table->string('beachName');
            $table->string('homePhone');
            $table->string('cellPhone');
            $table->string('streetAddressOne');
            $table->string('streetAddressTwo');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('country');
            $table->string('linkedinProfile');
            $table->string('facebookProfile');
            $table->string('membershipToken');
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
}
