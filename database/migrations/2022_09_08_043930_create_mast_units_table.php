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
        Schema::create('mast_units', function (Blueprint $table) {
            $table->id();
            $table->string('unit_name')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('mast_item_category_id')->nullable();
            $table->foreign('mast_item_category_id')->references('id')->on('mast_item_categories')->onDelete('cascade');
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
        Schema::dropIfExists('mast_units');
    }
};
