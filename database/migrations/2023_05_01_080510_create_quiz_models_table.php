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
        Schema::create('quiz_models', function (Blueprint $table) {
            $table->id();
            $table->integer('command')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->integer('question_count')->nullable();
            $table->boolean('question_active')->nullable();
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
        Schema::dropIfExists('quiz_models');
    }
};
