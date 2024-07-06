<?php

declare(strict_types=1);

use App\Enums\Complexity;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('performer_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->smallInteger('status');
            $table->smallInteger('complexity')->default(Complexity::Medium);
            $table->smallInteger('urgency')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('deadline_at')->nullable();

            $table->foreign('creator_id')->on('users')->references('id');
            $table->foreign('performer_id')->on('users')->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
