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
            $table->integer('team_id')->nullable();
            $table->integer('doc_id')->nullable();
            $table->integer('added_by');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile');
            $table->string('photo_path')->nullable();
            $table->string('email');
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
