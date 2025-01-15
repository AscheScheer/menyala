<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassroomController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/yes', function () {
    return view('yes');
})->middleware(['auth', 'verified'])->name('yes');

route::get('/user', [UserController::class, 'index', ], function () {
    return view('user');
})->middleware(['auth', 'verified'])->name('user');

route::get('/teacher', [TeacherController::class, 'index', ], function () {
    return view('teacher');
})->middleware(['auth', 'verified'])->name('teacher');

route::get('/student', [StudentController::class, 'index', ], function () {
    return view('student');
})->middleware(['auth', 'verified'])->name('student');


Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); // Form tambah data
Route::post('/users', [UserController::class, 'store'])->name('users.store'); // Simpan data

Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create'); // Form tambah data
Route::post('/students', [StudentController::class, 'store'])->name('students.store'); // Simpan data

Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('teachers.update');
Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create'); // Form tambah data
Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store'); // Simpan data

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

route::get('/classroom', [ClassroomController::class, 'index', ], function () {
    return view('classrooms.index');
})->middleware(['auth', 'verified'])->name('classroom');

Route::delete('/classrooms/{id}', [ClassroomController::class, 'destroy'])->name('classrooms.destroy');
Route::put('/classrooms/{id}', [ClassroomController::class, 'update'])->name('classrooms.update');
Route::get('/classrooms/{id}/edit', [ClassroomController::class, 'edit'])->name('classrooms.edit');
Route::get('/classrooms/create', [ClassroomController::class, 'create'])->name('classrooms.create'); // Form tambah data
Route::post('/classrooms', [ClassroomController::class, 'store'])->name('classrooms.store'); // Simpan data

Route::get('/classrooms/export/xml', [ClassroomController::class, 'exportXml'])->name('classrooms.export.xml');


require __DIR__ . '/auth.php';
