<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\DetermineUserLocation;

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

Route::middleware([ DetermineUserLocation::class ])->group(function () {
    //Inicio //TODO: !!!! Pendiente
    Route::get('/', function () { echo 'Hello World - home'; })->name('home');
    //Inicio //TODO: !!!! Pendiente
});
