<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id', false, true)
                ->nullable();
            $table->string('title')
                ->nullable();
            $table->text('description')
                ->nullable();
            $table->tinyInteger('status')
                ->default(\App\TaskStatuses::TODO);
            $table->dateTime('due_at')
                ->nullable();
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
