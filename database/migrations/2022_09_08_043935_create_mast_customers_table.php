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
        Schema::create('mast_customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('cont_person')->nullable();
            $table->string('cont_designation')->nullable();
            $table->string('cont_phone')->nullable();
            $table->text('cont_email')->nullable();
            $table->text('web_address')->nullable();
            $table->integer('credit_limit')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('mast_customer_type_id');
            $table->foreign('mast_customer_type_id')->references('id')->on('mast_customer_types')->onDelete('cascade');
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
        Schema::dropIfExists('mast_customers');
    }
};
