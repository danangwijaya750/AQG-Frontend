<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\AdminQuizController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminLevelController;
use App\Http\Controllers\AdminLessonController;
use App\Http\Controllers\AdminStudyController;
use App\Http\Controllers\ExportController;

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

Route::get('/', function () {
    return view('landing');
});

Route::group([
    'middleware' => ['auth', 'role:user']
], function () {
    Route::resource('quiz', QuizController::class);
    Route::resource('study', StudyController::class);
    Route::get('/lessons-search', [QuizController::class, 'search']);
    Route::get('/quiz/generated/{id}/{hash}',  [QuizController::class, 'generated'])->name('quiz.generated');
    Route::post('/quiz/generated/{id}/{hash}/save', [QuizController::class, 'save'])->name('quiz.save');
    Route::get('filter/lesson/{level_id}', [FilterController::class, 'getLesson'])->name('get.lesson');

});

Route::group([
    'middleware' => ['auth']
], function () {
    Route::get('filter/lesson/{level_id}', [FilterController::class, 'getLesson'])->name('get.lesson');
    Route::get('/quiz/{id}/pdf', [ExportController::class, 'exportPDF'])->name('quiz.pdf');
    Route::get('/study/{id}/pdf', [ExportController::class, 'exportStudyPDF'])->name('study.pdf');



});


Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'role:admin'],
    'as' => 'admin.'
], function(){
    Route::resource('quiz', AdminQuizController::class);
    Route::get('/quiz/generated/{id}/{hash}',  [AdminQuizController::class, 'generated'])->name('quiz.generated');
    Route::post('/quiz/generated/{id}/{hash}/save', [AdminQuizController::class, 'save'])->name('quiz.save');

    Route::resource('study', AdminStudyController::class);
    Route::resource('user', AdminUserController::class);
    Route::resource('lesson', AdminLessonController::class);
    Route::resource('level', AdminLevelController::class);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');





