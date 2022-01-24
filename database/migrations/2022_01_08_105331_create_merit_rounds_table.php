<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeritRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merit_rounds', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->string('round_no')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('merit_result_declare_date')->nullable();
            $table->boolean('status')->default(1)->comment('0 = inactive, 1 = active');
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
        Schema::dropIfExists('merit_rounds');
    }
}
