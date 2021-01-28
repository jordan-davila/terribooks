<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('house_id')
                  ->foreign('house_id')
                  ->references('id')->on('house')
                  ->onDelete('cascade');
            $table->string('number', 20);
            $table->string('symbol')->nullable();
            $table->string('color')->nullable();
            $table->string('observations', 255)->nullable();
            $table->unique(['house_id', 'number']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
