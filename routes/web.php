<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ReportController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/navbar', function () {
    return view('navbar');
});

Route::get('/events', [EventController::class, 'events'])->name('events');
Route::get('/', [EventController::class, 'index'])->name('index');
Route::get('/addevent', [EventController::class, 'create'])->name('addevent');
Route::post('/addevent', [EventController::class, 'store'])->name('create.event');
Route::delete('/events/{eventid}', [EventController::class, 'destroy'])->name('delete_event');
Route::get('/events/{eventid}/editevent', [EventController::class, 'edit'])->name('editevent');
Route::put('/events/{eventid}/editevent', [EventController::class, 'update'])->name('update_event');

Route::get('/student_info', [StudentController::class, 'student_info'])->name('student_info');
Route::get('/addstudent', [StudentController::class, 'create'])->name('addstudent');
Route::post('/addstudent', [StudentController::class, 'store'])->name('create.student');
Route::delete('/student_info/{id}', [StudentController::class, 'destroy'])->name('delete_student');

Route::get('/report', [ReportController::class, 'report'])->name('report');
