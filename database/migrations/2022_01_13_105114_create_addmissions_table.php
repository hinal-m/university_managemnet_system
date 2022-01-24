<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addmissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('merit')->nullable();
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');

            $table->unsignedBigInteger('merit_round_id');
            $table->foreign('merit_round_id')->references('id')->on('merit_rounds');
            $table->string('college_id')->nullable();
            $table->string('addmission_date')->nullable();
            $table->string('addmission_code')->nullable();
            $table->boolean('status')->comment('0 = next, 1 = confirm, 2 = reject, 3 = pending');

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
        Schema::dropIfExists('addmissions');
    }
}
