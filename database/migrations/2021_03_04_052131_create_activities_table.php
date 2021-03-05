<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('creator_id');
            $table->string('name');
            $table->unsignedBigInteger('points');
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('creator_id')->references('id')->on('users');
        });

        Schema::create('activity_user', function (Blueprint $table) {
            $table->foreignId('activity_id');
            $table->foreignId('user_id');
            $table->unsignedBigInteger('points_earned');
            $table->timestamps();

            // $table->foreign('activity_id')->references('id')->on('activities');
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_user');

        Schema::dropIfExists('activities');
    }
}
