<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_user', function (Blueprint $table) {
            $table->bigInteger('account_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('permission');
            $table->unique(['account_id', 'user_id']);
        });

        Schema::table('account_user', function($table){
            $table->foreign('account_id')->references('account_id')->on('account');
        });

        Schema::table('account_user', function($table){
            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_user', function(Blueprint $table){
            $table->dropUnique(['account_id', 'user_id']);
            $table->dropForeign('account_id');
            $table->dropForeign('user_id');
        });

        Schema::dropIfExists('account_user');
    }
}
