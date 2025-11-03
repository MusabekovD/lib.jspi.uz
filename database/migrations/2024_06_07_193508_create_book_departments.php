<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookDepartments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_departments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id'); // Updated data type to match 'books_lesson_and_manual' table's 'id' column
            $table->integer('department_id');
            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('books_lesson_and_manual')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_departments');
    }
}
