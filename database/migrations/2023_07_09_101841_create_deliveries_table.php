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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no')->nullable();
            $table->date('deli_date')->nullable();
            $table->unsignedInteger('warranty')->default(0);
            $table->decimal('price')->nullable();
            $table->unsignedBigInteger('sales_id');
            $table->foreign('sales_id')->references('id')->on('sales')->onDelete('cascade');
            $table->unsignedBigInteger('mast_customer_id');
            $table->foreign('mast_customer_id')->references('id')->on('mast_customers')->onDelete('cascade');
            $table->unsignedBigInteger('mast_work_station_id');
            $table->foreign('mast_work_station_id')->references('id')->on('mast_work_stations')->onDelete('cascade');
            $table->unsignedBigInteger('mast_item_register_id');
            $table->foreign('mast_item_register_id')->references('id')->on('mast_item_registers')->onDelete('cascade');
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
        Schema::dropIfExists('deliveries');
    }
};
