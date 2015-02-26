<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMessageUseridColumn extends Migration {
    public function up()
    {
        Schema::table('messages', function(Blueprint $table)
        {
            $table->integer('user_id');
        });
    }

    public function down()
    {
        Schema::table('messages', function(Blueprint $table)
        {
            $table->dropColumn('user_id');
        });
    }
}
