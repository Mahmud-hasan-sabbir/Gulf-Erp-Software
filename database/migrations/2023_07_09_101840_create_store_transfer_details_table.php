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
        Schema::create('store_transfer_details', function (Blueprint $table) {
            $table->id();
            $table->integer('qty')->nullable();
            $table->integer('deli_qty')->nullable();
            $table->unsignedBigInteger('mast_item_category_id')->nullable();
            $table->unsignedBigInteger('store_transfer_id');
            $table->foreign('store_transfer_id')->references('id')->on('store_transfers')->onDelete('cascade');
            $table->unsignedBigInteger('mast_item_register_id');
            $table->foreign('mast_item_register_id')->references('id')->on('mast_item_registers')->onDelete('cascade');
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
        Schema::dropIfExists('store_transfer_details');
    }
};
