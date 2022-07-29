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
        Schema::create('comments', function (Blueprint $table) {
          $table->increments('id');
          $table->char('user_id',64)->nullable();
          $table->integer('article_id')->nullable();
          $table->string('content', 255)->nullable();
          $table->timestamp('created_at')->nullable();
          $table->timestamp('updated_at');
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('comments');
            
    }
};
