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
        Schema::create('projects', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('client_id');
            $table->integer('site_id');
            $table->string('job_no');
            $table->string('name');
            $table->text('brief')->nullable();
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('sheet_url')->nullable();
            $table->date('status_changed_at')->nullable();
            $table->enum('status', ['Planning', 'Active', 'Complete', 'Handover', 'Archived'])->default('Planning');
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
        Schema::dropIfExists('projects');
    }
};
