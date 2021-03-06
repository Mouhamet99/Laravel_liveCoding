<?php

use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\PaysController;
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

Route::get('/pays', [PaysController:: class, 'index']);
Route::get('/pays/{id}', [PaysController:: class, 'getRegions'])->whereNumber('id');

Route::get('/entreprises', [EntrepriseController::class, 'index'])->name('entreprises.index');
Route::get('/entreprises/create', [EntrepriseController::class, 'create']);
Route::post('/entreprises/store', [EntrepriseController::class, 'store']);

Route::get('/entreprises/destroy/{id}', [EntrepriseController:: class, 'destroy'])->whereNumber('id');


