<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\JurnalistController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/blog/editor', [ArticleController::class,'editor'])->name('blog.editor');
Route::get('/blog/subiect', [ArticleController::class,'subiect'])->name('blog.subiect');
Route::get('/blog/jurnalist', [ArticleController::class,'jurnalist'])->name('jurnalist');
Route::get('/blog/categorised/{id}', [ArticleController::class,'categorised'])->name('categorised');
Route::get('/blog/archieved', [ArticleController::class,'archieved'])->name('archieved');
Route::get('/blog/unnaproved_journalists', [JurnalistController::class, 'index'])->name('unnapproved_journalists');
Route::patch('/blog/unnaproved_journalists/{id}', [JurnalistController::class, 'update'])->name('jurnalist.update');
Route::delete('/blog/unnaproved_journalists/{id}', [JurnalistController::class, 'destroy'])->name('jurnalist.destroy');
Route::resource('/blog', ArticleController::class);
