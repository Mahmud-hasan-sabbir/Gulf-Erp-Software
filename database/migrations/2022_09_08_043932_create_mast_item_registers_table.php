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
        Schema::create('mast_item_registers', function (Blueprint $table) {
            $table->id();
            $table->integer('box_code')->nullable();
            $table->integer('gulf_code')->nullable();
            $table->string('part_no')->nullable();
            $table->integer('box_qty')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('image')->nullable();
            $table->integer('warranty')->nullable();
            $table->string('bar_code')->nullable();
            $table->text('description')->nullable();
            
            $table->tinyInteger('unit_type')->nullable();
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('mast_units')->onDelete('cascade');
            $table->unsignedBigInteger('mast_item_models_id')->nullable();
            $table->unsignedBigInteger('mast_item_category_id')->nullable();
            $table->unsignedBigInteger('mast_item_group_id');
            $table->foreign('mast_item_group_id')->references('id')->on('mast_item_groups')->onDelete('cascade');
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
        Schema::dropIfExists('mast_item_registers');
    }
};
