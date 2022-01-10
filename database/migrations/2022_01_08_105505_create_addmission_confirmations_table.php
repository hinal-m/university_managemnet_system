<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddmissionConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addmission_confirmations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('addmission_id');
            $table->foreign('addmission_id')->references('id')->on('addmissions');
            $table->string('confirm_college_id')->nullable();
            $table->string('confirm_round_id')->nullable();
            $table->string('confirm_merit')->nullable();
            $table->enum('confirmation_type', ['M', 'R'])->nullable()->default('M')->comment('M = meritbase , R = reserved base');
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
        Schema::dropIfExists('addmission_confirmations');
    }
}
