<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegeCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('college_id');
            $table->foreign('college_id')->references('id')->on('colleges');

            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');

            $table->string('seat_no')->nullable();
            $table->string('reserved_seat')->nullable();
            $table->string('merit_seat')->nullable();
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
        Schema::dropIfExists('college_courses');
    }
}
