<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerritoriesTable extends Migration
{
    public function up()
    {
        Schema::create("territories", function (Blueprint $table) {
            $table->increments("id");
            $table
                ->unsignedInteger("city_id")
                ->foreign("city_id")
                ->references("id")
                ->on("city")
                ->onDelete("cascade");
            $table->integer("order")->nullable();
            $table->string("code")->nullable();
            $table->text("coordinates")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("territories");
    }
}
