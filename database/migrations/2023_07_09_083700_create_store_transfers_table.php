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
        Schema::create('store_transfers', function (Blueprint $table) {
            $table->id();
            $table->date('inv_date')->nullable();
            $table->string('inv_no')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('from_store_id')->nullable();
            $table->unsignedBigInteger('mast_work_station_id');
            $table->foreign('mast_work_station_id')->references('id')->on('mast_work_stations')->onDelete('cascade');
            $table->unsignedBigInteger('mast_item_category_id');
            $table->foreign('mast_item_category_id')->references('id')->on('mast_item_categories')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('is_parsial')->default(false);
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
        Schema::dropIfExists('store_transforms');
    }
};
