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
        $table->char('user_id',64);
        $table->string('email', 255);
        $table->string('pass', 255);
        $table->string('name', 255);
        $table->timestamp('created_at');
        $table->timestamp('updated_at')->nullable();
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
        Schema::dropIfExists('usersDefault');
    }
};
