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
        Schema::create('reference_list', function (Blueprint $table) {
            $table->id();
            $table->string('name_1');
            $table->string('number_1');
            $table->string('email_1');
            $table->string('name_2');
            $table->string('number_2');
            $table->string('email_2');
            // $table->string('status_1');
            // $table->string('status_2');
            $table->string('candidate_id');
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
        Schema::dropIfExists('reference_list');
    }
};
