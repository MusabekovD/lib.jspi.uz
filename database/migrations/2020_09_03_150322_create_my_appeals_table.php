<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyAppealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('like_books')) {
            Schema::create('my_appeals', function (Blueprint $table) {
                $table->id();
                $table->string('appeal_text', 500);
                $table->unsignedBigInteger('members_id');
                $table->tinyInteger('status')->default(0);
                $table->timestamps();
            });
            Schema::table('my_appeals', function (Blueprint $table) {
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
        Schema::dropIfExists('my_appeals');
    }
}
