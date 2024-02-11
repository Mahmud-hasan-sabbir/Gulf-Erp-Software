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
        Schema::create('salary_structures', function (Blueprint $table) {
            $table->id();
            $table->decimal('gross_salary', 10, 2)->nullable();
            $table->decimal('basic', 10, 2)->nullable();
            $table->decimal('house_rent', 10, 2)->nullable();
            $table->decimal('medical', 10, 2)->nullable();
            $table->decimal('conveyance', 10, 2)->nullable();
            $table->decimal('additional', 10, 2)->nullable();
            $table->decimal('overtime', 10, 2)->nullable();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->default(false);  //0 => Inactive || 1 => Active
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
        Schema::dropIfExists('salary_structures');
    }
};
