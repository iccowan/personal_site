<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Github extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("github_repos", function(Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->string("desc");
            $table->string("lang");
            $table->integer("commits");
            $table->string("most_recent_commit");
            $table->string("url");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("github_repos");
    }
}
