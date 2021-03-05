<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishersTable extends Migration
{
    public function up()
    {
        Schema::create("publishers", function (Blueprint $table) {
            $table->id();
            $table
                ->unsignedInteger("team_id")
                ->foreign("team_id")
                ->references("id")
                ->on("team")
                ->onDelete("cascade");
            $table->string("name");
            $table
                ->string("email")
                ->unique()
                ->nullable();
            $table->string("phone")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("publishers");
    }
}
