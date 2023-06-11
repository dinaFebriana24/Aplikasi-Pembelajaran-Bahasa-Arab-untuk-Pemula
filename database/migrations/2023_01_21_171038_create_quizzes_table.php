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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('sound');
            $table->string('teks');
            $table->string('gambar');
            $table->string('score');
            $table->string('answer_a');
            $table->string('answer_b');
            $table->string('answer_c');
            $table->enum('correct', ['a', 'b', 'c']);
            $table->unsignedBigInteger('main_category_id');
            $table->foreign('main_category_id')
                ->references('id')
                ->on('main_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
};
