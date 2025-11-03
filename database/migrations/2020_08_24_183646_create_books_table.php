<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('isbn')->nullable();
            $table->string('author')->nullable();
            $table->string('img')->nullable();
            $table->string('b_size', 20)->nullable();
            $table->integer('b_page_count')->nullable();
            $table->foreignId('category_id')->constrained('category_books');
            $table->unsignedInteger('user_id');

            $table->string('b_lang', 20)->nullable();
            $table->string('b_read_lang', 20)->nullable();
            $table->year('b_published_year')->nullable();
            $table->string('b_publishing', 30)->nullable();
            $table->string('file_path')->nullable();
            $table->string('telegram_msg_id')->nullable();
            $table->integer('view_count')->nullable();
            $table->timestamps();
        });
        Schema::table('books', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('admin_users')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
