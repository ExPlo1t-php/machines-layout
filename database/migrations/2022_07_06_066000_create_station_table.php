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
        Schema::create('station', function (Blueprint $table) {
            $table->string('name')->unique();
            $table->string('SN')->unique()->primary();
            $table->string('supplier');
            $table->string('mainIpAddr', 15)->unique();
            $table->integer('port');
            $table->longText('description')->nullable();
            // foreign key
            $table->unsignedInteger('switch');
            $table->foreign('switch')->references('switchId')->on('switch');
            $table->string('line', 20);
            $table->foreign('line')->references('name')->on('line');
            $table->string('type', 20);
            $table->foreign('type')->references('name')->on('station_type');
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
        Schema::dropIfExists('station');
    }
};
