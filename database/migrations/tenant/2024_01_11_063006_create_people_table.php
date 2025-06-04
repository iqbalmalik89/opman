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
        Schema::create('people', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('added_by');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country')->nullable();
            $table->string('county')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email', 200)->nullable();
            $table->string('nok')->nullable();
            $table->string('nok_contact')->nullable();
            $table->enum('is_fit', ['Yes', 'No'])->nullable();
            $table->string('medically_fit')->nullable();
            $table->text('medical_reason')->nullable();
            $table->string('ni_number')->nullable();
            $table->string('cpcs_number')->nullable();
            $table->string('eusr_number')->nullable();
            $table->string('nposr_number')->nullable();
            $table->string('utr_number')->nullable();
            $table->enum('is_valid_driving_license', ['Yes', 'No'])->nullable();
            $table->string('bank_detail')->nullable();
            $table->string('sort_code')->nullable();
            $table->string('category')->nullable();
            $table->integer('cat_id')->nullable();
            $table->date('dob')->nullable();
            $table->date('available_from')->nullable();
            $table->date('employ_start')->nullable();
            $table->text('admin_notes')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('driving_license_path')->nullable();
            $table->date('dl_expire')->nullable();
            $table->string('cv_path')->nullable();
            $table->string('reason')->nullable();
            $table->date('cv_expire')->nullable();
            $table->date('status_date')->nullable();
            $table->enum('dl_status', ['New', 'Expiring', 'Expired'])->nullable()->default('New');
            $table->enum('status', ['Active', 'Inactive', 'Banned', 'Deactivated'])->default('Inactive');
            $table->tinyInteger('rating')->nullable();
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
        Schema::dropIfExists('people');
    }
};
