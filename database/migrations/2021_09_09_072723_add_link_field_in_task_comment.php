<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLinkFieldInTaskComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('task_comment', function (Blueprint $table) {
           $table->string("link_type")->default(null)->after("file");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_comment', function (Blueprint $table) {
            $table->dropColumn("link_type");
        });
    }
}
