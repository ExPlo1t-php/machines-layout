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
            $table->string('IpAddr1', 15)->unique()->nullable();
            $table->string('IpAddr2', 15)->unique()->nullable();
            $table->string('IpAddr3', 15)->unique()->nullable();
            $table->integer('port');
            $table->longText('description')->nullable();
            $table->decimal('posTop',  4, 2)->nullable();
            $table->decimal('posLeft',  4, 2)->nullable();
            // foreign key
            $table->unsignedInteger('switch');
            $table->foreign('switch')->references('switchId')->on('switch')->onUpdate('cascade');
            $table->string('line', 20)->nullable();
            $table->foreign('line')->references('name')->on('line')->onUpdate('cascade');
            $table->string('type', 20);
            $table->foreign('type')->references('name')->on('station_type')->onUpdate('cascade');
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
