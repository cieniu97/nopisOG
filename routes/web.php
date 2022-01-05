<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\HomeController;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/', [HomeController::class, 'store'])->name('store');

Route::post('/search', [HomeController::class, 'search'])->name('search');
Route::get('/create', [HomeController::class, 'create'])->name('create');
Route::get('/exam/{exam}/notes', [HomeController::class, 'examNotes'])->name('examNotes');



Route::get('panel/', [PanelController::class, 'index'])->name('panel');
Route::post('panel/', [PanelController::class, 'store']);

Route::get('panel/get-fields/{universityName}', [PanelController::class, 'getFields']);
Route::get('panel/get-years/{universityName}/{fieldName}', [PanelController::class, 'getYears']);
Route::get('panel/get-subjects/{universityName}/{fieldName}/{yearName}', [PanelController::class, 'getSubjects']);




Route::resource('panel/users', UserController::class);


Route::get('panel/universities/trashed', [UniversityController::class, 'trashed'])->name('universities.trashed');
Route::post('panel/universities/restore/{id}', [UniversityController::class, 'restore'])->name('universities.restore');
Route::resource('panel/universities', UniversityController::class);


Route::get('panel/fields/trashed', [FieldController::class, 'trashed'])->name('fields.trashed');
Route::post('panel/fields/restore/{id}', [FieldController::class, 'restore'])->name('fields.restore');
Route::resource('panel/fields', FieldController::class);

Route::post('years/subscribe/{year}', [YearController::class, 'subscribe'])->name('years.subscribe');
Route::get('panel/years/trashed', [YearController::class, 'trashed'])->name('years.trashed');
Route::post('panel/years/restore/{id}', [YearController::class, 'restore'])->name('years.restore');
Route::resource('panel/years', YearController::class);

Route::post('subjects/subscribe/{subject}', [SubjectController::class, 'subscribe'])->name('subjects.subscribe');
Route::get('panel/subjects/trashed', [SubjectController::class, 'trashed'])->name('subjects.trashed');
Route::post('panel/subjects/restore/{id}', [SubjectController::class, 'restore'])->name('subjects.restore');
Route::resource('panel/subjects', SubjectController::class);

Route::get('panel/exams/trashed', [ExamController::class, 'trashed'])->name('exams.trashed');
Route::post('panel/exams/restore/{id}', [ExamController::class, 'restore'])->name('exams.restore');
Route::resource('panel/exams', ExamController::class);

Route::get('panel/notes/trashed', [NoteController::class, 'trashed'])->name('notes.trashed');
Route::post('panel/notes/restore/{id}', [NoteController::class, 'restore'])->name('notes.restore');
Route::resource('panel/notes', NoteController::class);

Route::resource('panel/subscriptions', SubscriptionController::class);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



