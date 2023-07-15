<?php

use App\Http\Controllers\ProfileController;
use App\Models\QuizSubmission;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/quiz/result', function () {
    return view('results');
})->middleware(['auth', 'verified'])->name('quiz.result');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/quiz', function () {

    // check if users quiz record is present
    $record = QuizSubmission::where('user_id', \Auth::user()->id)->exists();

    // if user has given a quiz then redirect to home
    if ($record) {
        return redirect()->route('dashboard');
    }
    return view('quiz');
})->middleware(['auth', 'verified'])->name('quiz');

Route::get('/leaderboard', function () {

    $leaderboards = QuizSubmission::orderBy('score', 'desc')->paginate(10);

    return view('leaderboard', compact('leaderboards'));
})->middleware(['auth', 'verified'])->name('leaderboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
