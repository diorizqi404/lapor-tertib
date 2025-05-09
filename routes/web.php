<?php

use App\Livewire\Admin\Academic;
use App\Livewire\Admin\Student;
use App\Livewire\Admin\Teacher;
use App\Livewire\Admin\ViolationCategory;
use App\Livewire\Admin\Violations;
use App\Livewire\Admin\Dashboard as DashboardAdmin;
use App\Livewire\Admin\Punishment;
use App\Livewire\Student\SearchStudent;
use App\Livewire\Student\StudentInfo;
use App\Livewire\Superadmin\Dashboard as DashboardSuperadmin;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('profile', 'livewire.admin.profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

//halaman dashboard untuk superadmin
Route::middleware([\App\Http\Middleware\SuperAdmin::class])->group(function () {
    Route::get('/superadmin', DashboardSuperadmin::class)
        ->name('superadmin.dashboard');
});

//halaman dashboard untuk admin
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', DashboardAdmin::class)->name('admin.dashboard');
    Route::get('dashboard/teacher', Teacher::class)->name('admin.teacher');
    Route::get('dashboard/academic', Academic::class)->name('admin.academic');
    Route::get('dashboard/student', Student::class)->name('admin.student');
    Route::get('dashboard/violation-category', ViolationCategory::class)->name('admin.violation-category');
    Route::get('dashboard/punishment', Punishment::class)->name('admin.punishment');
    Route::get('dashboard/violations', Violations::class)->name('admin.violations');
});



    Route::get('/student/search', SearchStudent::class)->name('student.search');
    Route::get('/student/info/{student}/{token}', StudentInfo::class)->name('student.info')->middleware('signed');
