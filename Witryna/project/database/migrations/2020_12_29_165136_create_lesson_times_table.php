<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_times', function (Blueprint $table) {
            $table->id();

            // lekcja w danym kursie
            $table->unsignedBigInteger('lesson_id')->default(1);
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');

            //data i godzina danego wystąpienia lekcji
            $table->time('time');
            $table->date('date');

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

        Schema::dropIfExists('lesson_times');
    }
}
