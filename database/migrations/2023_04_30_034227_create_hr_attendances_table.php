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
        Schema::create('hr_attendances', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->time('in_time')->nullable();
            $table->time('out_time')->nullable();
            $table->text('location')->nullable();
            $table->text('description')->nullable();
            $table->string('attendance_type')->nullable();
            $table->string('user_name')->nullable();
            $table->integer('finger_id')->nullable();
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('is_late')->default(false); //0 => In Time || 1 => Late
            $table->tinyInteger('status')->default(false);  //0 => Absent || 1 => Present || 2 => Leave || 3 => Holiday
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
        Schema::dropIfExists('hr_attendances');
    }
};
