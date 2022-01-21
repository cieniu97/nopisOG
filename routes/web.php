<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\HomeController;

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SocialiteController;





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
Route::get('/auth/discord/redirect', [SocialiteController::class, 'discordRedirect']);
Route::get('/auth/discord/callback', [SocialiteController::class, 'discordCallback']);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tos', function(){
    return view('tos');
});



Route::middleware(['auth'])->group(function () {
    Route::post('/', [HomeController::class, 'store'])->name('store');

    Route::post('/search', [HomeController::class, 'search'])->name('search');
    Route::get('/create', [HomeController::class, 'create'])->name('create');
    Route::get('/teacher/{name}', [HomeController::class, 'teacher']);
    
    
    Route::get('/files/download/note/{note}', [FileController::class, 'downloadAllNoteFiles']);
    Route::get('/files/download/{file}', [FileController::class, 'downloadFile']);
    
    
    
    Route::get('/get-fields', [HomeController::class, 'getFields']);
    Route::get('/get-years', [HomeController::class, 'getYears']);
    Route::get('/get-subjects', [HomeController::class, 'getSubjects']);
    
    
    Route::get('/universities/trashed', [UniversityController::class, 'trashed'])->name('universities.trashed');
    Route::post('/universities/restore/{id}', [UniversityController::class, 'restore'])->name('universities.restore');
    Route::resource('/universities', UniversityController::class);
    
    
    Route::get('/fields/trashed', [FieldController::class, 'trashed'])->name('fields.trashed');
    Route::post('/fields/restore/{id}', [FieldController::class, 'restore'])->name('fields.restore');
    Route::resource('/fields', FieldController::class);
    
    Route::post('years/subscribe/{year}', [YearController::class, 'subscribe'])->name('years.subscribe');
    Route::get('/years/trashed', [YearController::class, 'trashed'])->name('years.trashed');
    Route::post('/years/restore/{id}', [YearController::class, 'restore'])->name('years.restore');
    Route::resource('/years', YearController::class);
    
    Route::post('subjects/subscribe/{subject}', [SubjectController::class, 'subscribe'])->name('subjects.subscribe');
    Route::get('/subjects/trashed', [SubjectController::class, 'trashed'])->name('subjects.trashed');
    Route::post('/subjects/restore/{id}', [SubjectController::class, 'restore'])->name('subjects.restore');
    Route::resource('/subjects', SubjectController::class);
    
    Route::get('/exams/trashed', [ExamController::class, 'trashed'])->name('exams.trashed');
    Route::post('/exams/restore/{id}', [ExamController::class, 'restore'])->name('exams.restore');
    Route::resource('/exams', ExamController::class);
    
    Route::get('/notes/trashed', [NoteController::class, 'trashed'])->name('notes.trashed');
    Route::post('/notes/restore/{id}', [NoteController::class, 'restore'])->name('notes.restore');
    Route::resource('/notes', NoteController::class);
});


require __DIR__.'/auth.php';



