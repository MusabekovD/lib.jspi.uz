<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikeBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('like_books')) {
            Schema::create('like_books', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('books_id');
                $table->unsignedBigInteger('members_id');
                $table->timestamps();
            });
            Schema::table('like_books', function (Blueprint $table) {
                $table->foreign('books_id')->references('id')->on('books')->onDelete('cascade');
                $table->foreign('members_id')->references('telegram_id')->on('members')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('like_books');
    }
}
