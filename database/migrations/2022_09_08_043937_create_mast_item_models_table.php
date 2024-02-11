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
        Schema::create('mast_item_models', function (Blueprint $table) {
            $table->id();
            $table->string('ton')->nullable();
            $table->string('coling_capacity')->nullable();
            $table->string('indoor')->nullable();
            $table->string('outdoor')->nullable();
            $table->string('full_set')->nullable();
            $table->unsignedBigInteger('mast_item_group_id');
            $table->foreign('mast_item_group_id')->references('id')->on('mast_item_groups')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->default(false);
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
        Schema::dropIfExists('mast_item_models');
    }
};
