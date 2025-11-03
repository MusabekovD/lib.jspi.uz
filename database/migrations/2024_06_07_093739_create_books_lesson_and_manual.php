<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksLessonAndManual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_lesson_and_manual', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('isbn')->nullable();
            $table->unsignedBigInteger('author')->nullable();
            $table->string('desc')->nullable();
            $table->string('img')->nullable();
            $table->string('b_size', 20)->nullable();
            $table->integer('b_page_count')->nullable();
            $table->integer('category_id');
            $table->unsignedInteger('user_id');

            $table->unsignedBigInteger('b_lang')->nullable();
            $table->string('b_read_lang', 20)->nullable();
            $table->year('b_published_year')->nullable();
            $table->string('b_publishing', 30)->nullable();
            $table->string('file_path')->nullable();
            $table->string('telegram_msg_id')->nullable();
            $table->string('education_years')->nullable();
            $table->integer('view_count')->nullable();
            $table->integer('download_count')->nullable();
            $table->integer('lib_subject')->nullable();
            $table->json('course')->nullable();
            $table->integer('department')->nullable();

            $table->timestamps();
        });

        Schema::table('books_lesson_and_manual', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('admin_users')->onDelete('cascade');
            $table->foreign('b_lang')->references('id')->on('langs')->onDelete('cascade');
            $table->foreign('author')->references('id')->on('authors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books_lesson_and_manual');
    }
}
