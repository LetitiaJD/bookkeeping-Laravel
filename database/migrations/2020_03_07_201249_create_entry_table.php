<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entry', function (Blueprint $table){
            $table->bigIncrements('entry_id');
            $table->bigInteger('account_id')->unsigned()->index();
            $table->bigInteger('category_id')->unsigned()->index();
            $table->timestamp('entry_date')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->string('entry_description');
            $table->double('entry_amount');
        });

        Schema::table('entry', function($table){
            $table->foreign('account_id')->references('account_id')->on('account');
        });

        Schema::table('entry', function($table){
            $table->foreign('category_id')->references('category_id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entry');
    }
}
