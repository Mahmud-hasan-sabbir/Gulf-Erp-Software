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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('inv_date')->nullable();
            $table->string('inv_no')->nullable();
            $table->date('ref_date')->nullable();
            $table->string('ref_no')->nullable();
            $table->float('vat')->default(0.00)->nullable();
            $table->float('tax')->default(0.00)->nullable();
            $table->decimal('total')->nullable();
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('quotation_id')->nullable();
            $table->unsignedBigInteger('mast_item_category_id');
            $table->foreign('mast_item_category_id')->references('id')->on('mast_item_categories')->onDelete('cascade');
            $table->unsignedBigInteger('mast_customer_id');
            $table->foreign('mast_customer_id')->references('id')->on('mast_customers')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('is_parsial')->default(false);
            $table->tinyInteger('is_return')->default(false);
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
        Schema::dropIfExists('sales');
    }
};
