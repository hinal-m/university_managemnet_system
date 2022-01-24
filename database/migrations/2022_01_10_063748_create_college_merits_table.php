<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegeMeritsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_merits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('college_id');
            $table->foreign('college_id')->references('id')->on('colleges');

            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('college_courses');

            $table->unsignedBigInteger('merit_round_id');
            $table->foreign('merit_round_id')->references('id')->on('merit_rounds');

            $table->string('merit')->nullable()->comment('merit enter in %');
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
        Schema::dropIfExists('college_merits');
    }
}
