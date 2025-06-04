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
        Schema::create('settings', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('site_title');
            $table->string('splash_heading')->nullable();
            $table->string('splash_small_text')->nullable();
            $table->string('logo_img_path');
            $table->string('splash_img_path', 200)->nullable();
            $table->string('splash_bg_img_path', 200)->nullable();
            $table->string('favicon_img_path', 200)->nullable();
            $table->string('alert_emails')->nullable();
            $table->string('alert_phone_numbers')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
