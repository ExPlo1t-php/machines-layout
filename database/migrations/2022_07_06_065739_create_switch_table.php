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
        Schema::create('switch', function (Blueprint $table) {
            $table->increments('id');
            $table->string('switchName');
            $table->string('ipAddr')->unique();
            $table->integer('portsNum');
            
            // foreign key
            $table->string('cabName', 20)->nullable();
            $table->foreign('cabName')->references('name')
            ->on('network_cabinet')
            ->onUpdate('cascade')
            ->onDelete('set null');
        });
        
        
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('switch');
    }
};
