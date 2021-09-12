<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController as QuizController;
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
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/lessons-search', [QuizController::class, 'search']);
Route::get('/quiz/generated/{id}',  [QuizController::class, 'generated'])->name('quiz.generated');
Route::post('/quiz/generated/{id}/save', [QuizController::class, 'save'])->name('quiz.save');
Route::get('/quiz/{id}/pdf', [QuizController::class, 'createPDF'])->name('quiz.pdf');
Route::get('/quiz/{id}/txt', [QuizController::class, 'createTxt'])->name('quiz.txt');

Route::resource('quiz', QuizController::class);



