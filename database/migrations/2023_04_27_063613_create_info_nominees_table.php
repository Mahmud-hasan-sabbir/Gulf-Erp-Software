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
        Schema::create('info_nominees', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->integer('nid_no')->nullable();
            $table->string('relation')->nullable();
            $table->string('mobile_no')->nullable();
            $table->integer('nominee_percentage')->nullable();
            $table->string('profile_image')->nullable();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->default(true);
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
        Schema::dropIfExists('info_nominees');
    }
};
