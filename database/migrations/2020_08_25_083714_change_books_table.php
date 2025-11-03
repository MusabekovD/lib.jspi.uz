<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->unsignedBigInteger('b_lang')->nullable()->change();
            $table->unsignedBigInteger('author')->nullable()->change();
        });

        Schema::table('books', function (Blueprint $table) {
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
        //
    }
}
