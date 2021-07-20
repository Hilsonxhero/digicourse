<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('season_id')->unsigned()->nullable();
            $table->bigInteger('media_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('slug');
            $table->tinyInteger('time')->unsigned()->nullable();
            $table->integer('position')->unsigned()->nullable();
            $table->boolean('free')->default(false);
            $table->longText('body')->nullable();
            $table->enum('confirmation_status', \Course\Models\Lesson::$confirmationStatuses)
                ->default(\Course\Models\Season::CONFIRMATION_STATUS_PENDING);
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
