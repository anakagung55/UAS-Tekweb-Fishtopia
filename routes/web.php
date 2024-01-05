<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CentrePointController;
use App\Http\Controllers\Backend\DataController;
use App\Http\Controllers\Backend\SpotController;

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

Route::get('/',[HomeController::class,'spots']);
Route::get('/detail-spot/{slug}',[HomeController::class,'detailSpot'])->name('detail-spot');
Route::get('/', HomeController::class)->name('home');

Route::get('/blog', [PostController::class, 'index'])->name('posts.index');

Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('posts.show');

## Route Datatable
Route::get('/centre-point/data',[DataController::class,'centrepoint'])->name('centre-point.data');
Route::get('/spot/data',[DataController::class,'spot'])->name('spot.data');
  
Route::resource('centre-point',(CentrePointController::class));
Route::resource('spot',(SpotController::class));

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});