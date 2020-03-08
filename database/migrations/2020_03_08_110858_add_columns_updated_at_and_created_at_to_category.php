<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsUpdatedAtAndCreatedAtToCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('category', function (Blueprint $table) {
          $table->datetime('updated_at')->after('category_name');
      });
      Schema::table('category', function (Blueprint $table) {
          $table->datetime('created_at')->after('updated_at');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category', function (Blueprint $table) {
          $table->dropColumn('updated_at');
          $table->dropColumn('created_at');
        });
    }
}
