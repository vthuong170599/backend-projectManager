<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('subject');
            $table->tinyInteger('status');
            $table->text('content');
            $table->integer('priority');
            $table->string('spent_time')->nullable();
            $table->string('estimated_time');
            $table->string('start_date');
            $table->string('due_date');
            $table->bigInteger('member_id');
            $table->bigInteger('id_project');
            $table->text('note');
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
        Schema::dropIfExists('tasks');
    }
}
