<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lesson_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('rating'); // 1-5 stars
            $table->text('review')->nullable();
            $table->boolean('is_helpful')->default(false);
            $table->integer('helpful_count')->default(0);
            $table->timestamps();
            
            $table->unique(['lesson_id', 'user_id']);
        });

        // Add average rating to lessons table
        Schema::table('lessons', function (Blueprint $table) {
            $table->decimal('average_rating', 3, 2)->nullable()->after('points');
            $table->integer('total_reviews')->default(0)->after('average_rating');
        });
    }

    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn(['average_rating', 'total_reviews']);
        });
        
        Schema::dropIfExists('lesson_reviews');
    }
};
