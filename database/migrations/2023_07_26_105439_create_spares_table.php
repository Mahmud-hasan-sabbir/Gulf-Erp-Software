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
        Schema::create('spares', function (Blueprint $table) {
            $table->id();
            $table->string('requ_no')->nullable();
            $table->date('requ_date')->nullable();
            $table->tinyInteger('status')->default(false);
            $table->text('remarks')->nullable();
            $table->integer('mast_item_category_id')->nullable();
            $table->integer('complaint_id')->nullable();
            // $table->integer('tech_id')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('spares');
    }
};
