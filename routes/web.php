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

// Authentication Routes
require __DIR__.'/auth.php';

// User Dashboard Routes (Protected)
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
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
