<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CertificateController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/lessons', [LessonController::class, 'index'])->name('lessons.index');
Route::get('/lessons/{id}', [LessonController::class, 'show'])->name('lessons.show');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard/teacher', [DashboardController::class, 'teacher'])
        ->name('dashboard.teacher')
        ->middleware('role:teacher');
    
    // Teacher Lesson Management
    Route::middleware('role:teacher')->prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/lessons/create', [App\Http\Controllers\Teacher\TeacherLessonController::class, 'create'])->name('lessons.create');
        Route::post('/lessons', [App\Http\Controllers\Teacher\TeacherLessonController::class, 'store'])->name('lessons.store');
        Route::get('/lessons/{lesson}/edit', [App\Http\Controllers\Teacher\TeacherLessonController::class, 'edit'])->name('lessons.edit');
        Route::put('/lessons/{lesson}', [App\Http\Controllers\Teacher\TeacherLessonController::class, 'update'])->name('lessons.update');
        Route::delete('/lessons/{lesson}', [App\Http\Controllers\Teacher\TeacherLessonController::class, 'destroy'])->name('lessons.destroy');
    });
    
    Route::get('/dashboard/student', [DashboardController::class, 'student'])
        ->name('dashboard.student')
        ->middleware('role:student');
    
    // Enrollment route for students only
    Route::post('/enroll/{lessonId}', [DashboardController::class, 'enrollInLesson'])
        ->name('lessons.enroll')
        ->middleware('role:student');

    // Comments
    Route::post('/lessons/{lesson}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/{comment}/like', [CommentController::class, 'toggleLike'])->name('comments.like');
    Route::post('/comments/{comment}/answer', [CommentController::class, 'markAsAnswered'])->name('comments.answer');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Reviews
    Route::post('/lessons/{lesson}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unreadCount');

    // Certificates
    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::post('/lessons/{lesson}/certificate', [CertificateController::class, 'generate'])->name('certificates.generate');
    Route::get('/certificates/{certificate}/download', [CertificateController::class, 'download'])->name('certificates.download');

    // Quizzes
    Route::get('/lessons/{lesson}/quiz', [App\Http\Controllers\QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{quiz}/start', [App\Http\Controllers\QuizController::class, 'start'])->name('quizzes.start');
    Route::get('/quiz-attempts/{attempt}', [App\Http\Controllers\QuizController::class, 'take'])->name('quizzes.take');
    Route::post('/quiz-attempts/{attempt}/submit', [App\Http\Controllers\QuizController::class, 'submit'])->name('quizzes.submit');
    Route::get('/quiz-attempts/{attempt}/result', [App\Http\Controllers\QuizController::class, 'result'])->name('quizzes.result');
    
    // Leaderboard
    Route::get('/leaderboard', [App\Http\Controllers\QuizController::class, 'leaderboard'])->name('leaderboard');
});

// Redirect old dashboard route
Route::get('/dashboard', function () {
    if (auth()->check()) {
        if (auth()->user()->isTeacher()) {
            return redirect('/dashboard/teacher');
        } else {
            return redirect('/dashboard/student');
        }
    }
    return redirect('/login');
})->middleware('auth');
