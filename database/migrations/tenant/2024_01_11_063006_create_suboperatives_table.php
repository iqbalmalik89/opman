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
        Schema::create('suboperatives', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('subcontractor_id');
            $table->integer('added_by');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('email')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Inactive');
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
        Schema::dropIfExists('suboperatives');
    }
};
