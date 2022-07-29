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
        Schema::create('users', function (Blueprint $table) {
          $table->increments('id');
          $table->char('user_id',64)->nullable();
          $table->string('email', 255)->nullable();
          $table->string('pass', 255)->nullable();
          $table->string('name', 255)->nullable();
          $table->timestamp('created_at')->nullable();
          $table->timestamp('updated_at');
          $table->softDeletes();
          $table->tinyInteger('admin',)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
