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
        Schema::table('lessons', function (Blueprint $table) {
            $table->longText('content')->nullable()->after('description');
            $table->integer('points')->default(10)->after('video_url');
            $table->string('difficulty_level')->default('beginner')->after('points');
            $table->json('resources')->nullable()->after('difficulty_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn(['content', 'points', 'difficulty_level', 'resources']);
        });
    }
};
