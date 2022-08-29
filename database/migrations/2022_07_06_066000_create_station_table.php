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
              $table->boolean('state')->nullable();
            $table->string('IpAddr1', 15)->unique()->nullable();
            $table->string('IpAddr2', 15)->unique()->nullable();
            $table->string('IpAddr3', 15)->unique()->nullable();
            $table->integer('port');
            $table->longText('description')->nullable();
            $table->decimal('posTop',  4, 0)->nullable();
            $table->decimal('posLeft',  4, 0)->nullable();
            // foreign key
            $table->unsignedInteger('switch')->nullable();
            $table->foreign('switch')->references('id')->on('switch')->onUpdate('cascade')->onDelete('set null');
            $table->string('line', 20)->nullable();
            $table->foreign('line')->references('name')->on('line')->onUpdate('cascade')->onDelete('set null');
            $table->string('type', 20)->nullable();
            $table->foreign('type')->references('name')->on('station_type')->onUpdate('cascade')->onDelete('set null');
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
