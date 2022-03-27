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
use App\Http\Controllers\LandingController;

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

Route::get('/', [LandingController::class, 'index']);
// Route::get('/', function(){
//     return view('auth.login');
// });

Route::get('/quiz/all', [LandingController::class, 'allQuiz'])->name('quiz.all');
Route::get('/study/all', [LandingController::class, 'allStudy'])->name('study.all');
Route::get('/quiz/{id}/detail', [LandingController::class, 'showQuiz'])->name('quiz.detail');
Route::get('/study/{id}/detail', [LandingController::class, 'showStudy'])->name('study.detail');

Route::get('/quiz/{id}/public/pdf', [ExportController::class, 'exportPDF'])->name('quiz.public.pdf');
Route::get('/studu/{id}/public/pdf', [ExportController::class, 'exportStudyPDF'])->name('study.public.pdf');

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
    Route::get('filter/study/{user_id}', [FilterController::class, 'getStudy'])->name('get.study');

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





