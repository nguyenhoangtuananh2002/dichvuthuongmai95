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
        Schema::create('driver_ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('rating');
            $table->text('review')->nullable();
            $table->timestamps();
            $table->foreign('driver_id')->references('id')->on('employees');
            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_ratings');
    }
};
