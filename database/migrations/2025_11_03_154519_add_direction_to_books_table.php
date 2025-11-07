<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDirectionToBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books_lesson_and_manual', function (Blueprint $table) {
            if (Schema::hasColumn('books_lesson_and_manual', 'direction')) {

                $table->json('direction')->nullable()->change();
            } else {
                $table->json('direction')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books_lesson_and_manual', function (Blueprint $table) {
            //
        });
    }
}
