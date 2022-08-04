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
          $table->id();
          $table->char('user_id',64)->references('user_id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
          $table->foreignId('article_id')->constrained('articles')->cascadeOnUpdate()->cascadeOnDelete();
          $table->string('content', 255);
          $table->timestamps();
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
