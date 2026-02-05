<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('task', 200);
            $table->date('begindate');
            $table->date('enddate')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('activity_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('project_id')
                ->references('id')->on('projects')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('activity_id')
                ->references('id')->on('activities')
                ->restrictOnDelete()->restrictOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
