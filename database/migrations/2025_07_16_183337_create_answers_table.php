<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questionId')->constrained('questions')->onDelete('cascade');
            $table->foreignId('authorId')->constrained('users')->onDelete('cascade');
            $table->text('answerBody');
            $table->integer('likeCount')->default(0);
            $table->integer('dislikeCount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
