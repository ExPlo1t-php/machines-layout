<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'mysql';
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
            $table->string('supplier')->nullable();
            $table->string('IpAddr', 15)->nullable()->unique();
            $table->boolean('state')->nullable();
            $table->integer('port')->nullable();
            $table->longText('description')->nullable();
            // foreign key
            $table->unsignedInteger('switch')->nullable();
            $table->foreign('switch')->references('id')->on('switch')->onUpdate('cascade')->onDelete('set null');
            $table->string('type')->nullable();
            $table->foreign('type')->references('name')->on('equipment_type')->onUpdate('cascade')->onDelete('set null');
            $table->string('station')->nullable();
            $table->foreign('station')->references('name')->on('station')->onUpdate('cascade')->onDelete('set null');
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
