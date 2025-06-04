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
        Schema::create('trainings', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('people_id');
            $table->integer('doc_id')->nullable();
            $table->integer('doc_class');
            $table->text('course_provider')->nullable();
            $table->date('course_date');
            $table->string('course_location');
            $table->enum('status', ['Active', 'Pending', 'Confirmed', 'Abandoned'])->default('Active');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trainings');
    }
};
