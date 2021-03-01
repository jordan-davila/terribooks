<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    public function up()
    {
        Schema::create("assignments", function (Blueprint $table) {
            $table->id();
            $table
                ->unsignedInteger("team_id")
                ->foreign("team_id")
                ->references("id")
                ->on("team")
                ->onDelete("cascade");
            $table
                ->unsignedInteger("territory_id")
                ->foreign("territory_id")
                ->references("id")
                ->on("territory")
                ->onDelete("cascade");
            $table
                ->unsignedInteger("publisher_id")
                ->foreign("publisher_id")
                ->references("id")
                ->on("publisher")
                ->onDelete("cascade")
                ->nullable();
            $table->string("type");
            $table->boolean("current")->default(false);
            $table->date("date_in")->nullable();
            $table->date("date_out")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists("assignments");
    }
}
