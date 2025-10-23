<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Quiz table - one quiz per lesson
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('passing_score')->default(75); // Percentage to pass
            $table->integer('time_limit')->nullable(); // Minutes (optional)
            $table->integer('max_attempts')->default(3); // Maximum attempts allowed
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Questions table - 4 questions per quiz
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->text('question');
            $table->integer('points')->default(25); // 25 points each = 100 total
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Answers table - 3 options per question, 1 correct
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('quiz_questions')->onDelete('cascade');
            $table->text('answer');
            $table->boolean('is_correct')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Quiz attempts - track student attempts
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('score')->default(0); // 0-100
            $table->integer('correct_answers')->default(0);
            $table->integer('total_questions')->default(4);
            $table->boolean('passed')->default(false);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->integer('time_spent')->nullable(); // Seconds
            $table->json('answers')->nullable(); // Store user answers
            $table->timestamps();
        });

        // Add quiz_passed column to lesson_enrollments
        Schema::table('lesson_enrollments', function (Blueprint $table) {
            $table->boolean('quiz_passed')->default(false)->after('completed');
            $table->integer('quiz_score')->nullable()->after('quiz_passed');
            $table->integer('quiz_attempts')->default(0)->after('quiz_score');
        });
    }

    public function down(): void
    {
        Schema::table('lesson_enrollments', function (Blueprint $table) {
            $table->dropColumn(['quiz_passed', 'quiz_score', 'quiz_attempts']);
        });
        
        Schema::dropIfExists('quiz_attempts');
        Schema::dropIfExists('quiz_answers');
        Schema::dropIfExists('quiz_questions');
        Schema::dropIfExists('quizzes');
    }
};
