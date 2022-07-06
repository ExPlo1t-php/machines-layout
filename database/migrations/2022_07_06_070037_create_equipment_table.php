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
        Schema::create('equipment', function (Blueprint $table) {
            $table->string('name');
            $table->string('SN')->unique()->primary();
            $table->string('supplier');
            $table->string('IpAddr', 15)->unique();
            $table->integer('port');
            $table->longText('description');
            // foreign key
            $table->string('type')->unique();
            $table->foreign('type')->references('name')->on('equipment_type');
            $table->string('station');
            $table->foreign('station')->references('name')->on('station');
            // foreign key
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment');
    }
};
