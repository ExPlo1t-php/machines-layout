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
        Schema::create('line', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20)->unique();
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->decimal('posTop',  4, 0)->nullable();
            $table->decimal('posLeft',  4, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('line');
    }
};
