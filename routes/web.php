<?php

use App\Livewire\HomePage;
use App\Livewire\AboutPage;
use App\Livewire\CoursesPage;
use App\Livewire\CourseDetailsPage;
use App\Livewire\ContactPage;
use Illuminate\Support\Facades\Route;

// Public Website Routes
Route::get('/', HomePage::class)->name('home');
Route::get('/about', AboutPage::class)->name('about');
Route::get('/courses', CoursesPage::class)->name('courses');
Route::get('/courses/{id}', CourseDetailsPage::class)->name('course.details');
Route::get('/contact', ContactPage::class)->name('contact');

// Assessment Preview (for admin)
Route::get('/assessment/preview/{id}', \App\Livewire\AssessmentPreviewPage::class)->name('assessment.preview');

// Authentication Routes
require __DIR__.'/auth.php';

// Onboarding Routes (Protected, but before onboarding check)
Route::middleware(['auth'])->group(function () {
    Route::get('/choose-starting-point', \App\Livewire\ChooseStartingPoint::class)->name('choose-starting-point');
    Route::get('/assessment/{id}', \App\Livewire\AssessmentPage::class)->name('assessment.start');
    Route::get('/assessment/results/{id}', \App\Livewire\AssessmentResultsPage::class)->name('assessment.results');
    Route::get('/level-exam/{level}', \App\Livewire\LevelExamPage::class)->name('level-exam.start');
    Route::get('/level-exam/results/{id}', function ($id) {
        $userExam = \App\Models\UserLevelExam::with(['levelExam'])->where('user_id', auth()->id())->findOrFail($id);
        return view('level-exam-results', ['userExam' => $userExam]);
    })->name('level-exam.results');
});

// User Dashboard Routes (Protected - requires onboarding)
Route::middleware(['auth', \App\Http\Middleware\EnsureOnboardingCompleted::class])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');
    
    Route::get('/my-courses', function () {
        return view('user.my-courses');
    })->name('my-courses');
    
    Route::get('/course/{id}', function ($id) {
        return view('user.course', ['courseId' => $id]);
    })->name('course');
    
    Route::get('/progress', function () {
        return view('user.progress');
    })->name('progress');
    
    Route::get('/certificates', function () {
        return view('user.certificates');
    })->name('certificates');
    
    Route::get('/profile', function () {
        return view('user.profile');
    })->name('profile');
});
