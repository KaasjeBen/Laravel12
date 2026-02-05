<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('label_task', function (Blueprint $table) {
            $table->unsignedInteger('label_id');
            $table->unsignedInteger('task_id');
            $table->primary(['label_id', 'task_id']);

            $table->foreign('label_id')->references('id')->on('labels')->cascadeOnDelete();
            $table->foreign('task_id')->references('id')->on('tasks')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('label_task');
    }
};
