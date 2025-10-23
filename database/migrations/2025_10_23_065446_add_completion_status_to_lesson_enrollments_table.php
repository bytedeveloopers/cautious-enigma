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
        Schema::table('lesson_enrollments', function (Blueprint $table) {
            $table->boolean('completed')->default(false)->after('lesson_id');
            $table->timestamp('completed_at')->nullable()->after('completed');
            $table->integer('progress_percentage')->default(0)->after('completed_at');
            $table->integer('time_spent')->default(0)->after('progress_percentage'); // en minutos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lesson_enrollments', function (Blueprint $table) {
            $table->dropColumn(['completed', 'completed_at', 'progress_percentage', 'time_spent']);
        });
    }
};
