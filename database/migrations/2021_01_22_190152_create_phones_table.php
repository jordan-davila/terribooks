<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesTable extends Migration
{
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table
                ->unsignedInteger('street_id')
                ->foreign('street_id')
                ->references('id')
                ->on('street')
                ->onDelete('cascade');
            $table->string('number', 30);
            $table->string('apartment', 30)->nullable();
            $table->string('name')->nullable();
            $table->string('symbol')->nullable();
            $table->string('color')->nullable();
            $table->string('phone')->nullable();
            $table->string('observations')->nullable();
            $table->unique(['street_id', 'number', 'apartment']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('phones');
    }
}
