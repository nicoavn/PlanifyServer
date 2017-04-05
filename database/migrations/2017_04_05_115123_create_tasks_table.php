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
            $table->string('name');
            $table->string('description');
            $table->dateTime('due_date');
            $table->string('color');

            $table->unsignedInteger('project_id');
            $table->unsignedInteger('created_by_user_id');
            $table->unsignedInteger('assigned_to_user_id');
            $table->unsignedInteger('priority_level_id');
            $table->unsignedInteger('status_id');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('tasks', function(Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects');

            $table->foreign('created_by_user_id')->references('id')->on('users');
            $table->foreign('assigned_to_user_id')->references('id')->on('users');

            $table->foreign('priority_level_id')->references('id')->on('priority_levels');
            $table->foreign('status_id')->references('id')->on('statuses');
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
