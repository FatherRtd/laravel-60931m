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
        Schema::create("user", function (Blueprint $table) {
            $table->id();
            $table->string("first_name");
            $table->string("sur_name");
            $table->string("email");
            $table->string("password");
        });

        Schema::create("activity_type", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->unsignedInteger("max_mark");
        });

        Schema::create("team", function (Blueprint $table) {
            $table->id();
            $table->string("name");
        });

        Schema::create("team_user", function (Blueprint $table) {
            $table->unsignedInteger("user_id");
            $table->unsignedInteger("team_id");
            $table->foreign("user_id")->references("id")->on("user");
            $table->foreign("team_id")->references("id")->on("team");
        });

        Schema::create("activity", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description");
            $table->unsignedInteger("owner_id");
            $table->unsignedInteger("team_id");
            $table->unsignedInteger("activity_type_id");
            $table->timestamp("start_date");
            $table->timestamp("end_date");
            $table->foreign("owner_id")->references("id")->on("user");
            $table->foreign("team_id")->references("id")->on("team");
            $table->foreign("activity_type_id")->references("id")->on("activity_type");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("activity");
        Schema::dropIfExists("user");
        Schema::dropIfExists("activity_type");
        Schema::dropIfExists("team");
        Schema::dropIfExists("team_user");
    }
};
