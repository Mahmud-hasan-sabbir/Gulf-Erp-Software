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
        Schema::create('info_personals', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_birth')->nullable();
            $table->integer('employee_gender')->nullable();
            $table->string('nid_no')->nullable();
            $table->integer('blood_group')->nullable();
            $table->string('number_official')->nullable();
            $table->string('email_official')->nullable();
            $table->date('joining_date')->nullable();
            $table->integer('service_length')->nullable();
            $table->double('gross_salary')->nullable();
            $table->integer('reporting_boss')->nullable();
            $table->tinyInteger('is_reporting_boss')->default(false);
            $table->integer('division_present')->nullable();
            $table->integer('district_present')->nullable();
            $table->integer('upazila_present')->nullable();
            $table->integer('union_present')->nullable();
            $table->string('thana_present')->nullable();
            $table->integer('post_code_present')->nullable();
            $table->string('address_present')->nullable();
            
            $table->integer('division_permanent')->nullable();
            $table->integer('district_permanent')->nullable();
            $table->integer('upazila_permanent')->nullable();
            $table->integer('union_permanent')->nullable();
            $table->string('thana_permanent')->nullable();
            $table->integer('post_code_permanent')->nullable();
            $table->string('address_permanent')->nullable();

            $table->string('passport_no')->nullable();
            $table->string('driving_license')->nullable();
            $table->integer('marital_status')->nullable();
            $table->string('house_phone')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->bigInteger('birth_certificate_no')->nullable();
            $table->string('emg_person_name')->nullable();
            $table->string('emg_phone_number')->nullable();
            $table->string('emg_relationship')->nullable();
            $table->text('emg_address')->nullable();
            
            $table->unsignedBigInteger('mast_department_id');
            $table->foreign('mast_department_id')->references('id')->on('mast_departments')->onDelete('cascade');
            $table->unsignedBigInteger('mast_designation_id');
            $table->foreign('mast_designation_id')->references('id')->on('mast_designations')->onDelete('cascade');
            $table->unsignedBigInteger('mast_employee_type_id');
            $table->foreign('mast_employee_type_id')->references('id')->on('mast_employee_types')->onDelete('cascade');
            $table->unsignedBigInteger('mast_work_station_id');
            $table->foreign('mast_work_station_id')->references('id')->on('mast_work_stations')->onDelete('cascade');
            $table->unsignedBigInteger('emp_id');
            $table->foreign('emp_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('info_personals');
    }
};
