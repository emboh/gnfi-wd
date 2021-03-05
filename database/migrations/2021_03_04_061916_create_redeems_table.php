<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedeemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redeems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->nullable();
            $table->foreignId('member_id');
            $table->foreignId('reward_id');
            $table->unsignedBigInteger('points_spent');
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('admin_id')->references('id')->on('users');
            // $table->foreign('member_id')->references('id')->on('users');
            // $table->foreign('reward_id')->references('id')->on('rewards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('redeems');
    }
}
