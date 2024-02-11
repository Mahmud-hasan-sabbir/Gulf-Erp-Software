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
        Schema::create('salary_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('salary_year', 10, 2)->nullable();
            $table->string('salary_month', 10, 2)->nullable();
            
            $table->decimal('basic_pay', 10, 2)->nullable();
            $table->decimal('house_rent_pay', 10, 2)->nullable();
            $table->decimal('medical_pay', 10, 2)->nullable();
            $table->decimal('conveyance_pay', 10, 2)->nullable();
            $table->decimal('additional_pay', 10, 2)->nullable();

            $table->decimal('basic', 10, 2)->nullable();
            $table->decimal('house_rent', 10, 2)->nullable();
            $table->decimal('medical', 10, 2)->nullable();
            $table->decimal('conveyance', 10, 2)->nullable();
            $table->decimal('additional', 10, 2)->nullable();
            $table->decimal('gross', 10, 2)->nullable(); //Total Gross

            $table->decimal('pf_dedaction', 10, 2)->nullable();
            $table->decimal('loan_dedaction', 10, 2)->nullable();
            $table->decimal('tax_dedaction', 10, 2)->nullable();
            $table->decimal('mobile_dedaction', 10, 2)->nullable();
            $table->decimal('other_dedaction', 10, 2)->nullable();
            $table->decimal('dedaction', 10, 2)->nullable(); //Total Dedaction
            
            $table->decimal('net_pay', 10, 2)->nullable();

            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('mast_work_station_id');
            $table->foreign('mast_work_station_id')->references('id')->on('mast_work_stations')->onDelete('cascade');
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
        Schema::dropIfExists('salary_sheets');
    }
};
