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
        Schema::create('base_permissions', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('permission')->unique('permission');
            $table->boolean('owner')->default(false);
            $table->boolean('super_admin')->default(false);
            $table->boolean('admin')->default(false);
            $table->boolean('manager')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('base_permissions');
    }
};
