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
        Schema::create('notification_log', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('entity_id');
            $table->string('type');
            $table->enum('channel', ['email', 'sms'])->default('email');
            $table->enum('doc_type', ['people', 'subop'])->default('people');
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
        Schema::dropIfExists('notification_log');
    }
};
