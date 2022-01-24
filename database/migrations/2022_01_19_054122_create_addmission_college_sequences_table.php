<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddmissionCollegeSequencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addmission_college_sequences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('addmission_id');
            $table->foreign('addmission_id')->references('id')->on('addmissions');

            $table->unsignedBigInteger('college_id');
            $table->foreign('college_id')->references('id')->on('colleges');
            $table->softDeletes();
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
        Schema::dropIfExists('addmission_college_sequences');
    }
}
