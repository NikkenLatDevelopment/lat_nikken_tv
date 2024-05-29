<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TemporalController;
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

//Seleccionar país
Route::get('/pais/{countryId}', [ CountryController::class, 'update' ])->name('country.update');
Route::get('/pais', [ CountryController::class, 'index' ])->name('country.index');

//Eliminar // ! TODO: !!!! Eliminar
Route::get('/temporal/decode/{data}', [ TemporalController::class, 'decode' ]);

Route::middleware([ DetermineUserLocation::class ])->group(function () {
    //Inicio //TODO: !!!! Pendiente
    Route::get('/', function () { echo 'Hello World - home'; })->name('home');

    //Iniciar Sesión
    Route::get('/iniciar-sesion', [ AuthController::class, 'index' ])->name('login');

    //Registro //TODO: !!!! Pendiente
    Route::get('/registrarme', function () { echo 'Hello World - auth.create'; })->name('auth.create');

    //Contacto //TODO: !!!! Pendiente
    Route::get('/contacto', function () { echo 'Hello World - contact.show'; })->name('contact.show');

    //Buscar producto //TODO: !!!! Pendiente
    Route::get('/buscar/{search?}', [ ProductController::class, 'index' ])->name('search.show');

    //Campaña //TODO: !!!! Pendiente
    Route::get('/campana/{campaignSlug}', function () { echo 'Hello World - campaign.show'; })->name('campaign.show');

    //Repuestos y Piezas //TODO: !!!! Pendiente
    Route::get('/productos/repuestos-piezas', function () { echo 'Hello World - replacement.index'; })->name('replacement.index');

    //Repuestos y Piezas //TODO: !!!! Pendiente
    Route::get('/productos/eventos', function () { echo 'Hello World - event.index'; })->name('event.index');

    //Repuestos y Piezas //TODO: !!!! Pendiente
    Route::get('/productos/herramientas', function () { echo 'Hello World - tool.index'; })->name('tool.index');

    //Categoría //TODO: !!!! Pendiente
    Route::get('/productos/{brandSlug}', function () { echo 'Hello World - category.show'; })->name('category.show');

    //Producto
    Route::get('/productos/{brandSlug}/{productSlug}', [ ProductController::class, 'show' ])->name('product.show');
    //Producto

    //Productos //TODO: !!!! Pendiente
    Route::get('/productos', function () { echo 'Hello World - product.index'; })->name('product.index');

    Route::middleware('auth')->group(function () {
        //Cerrar sesión
        Route::get('/cerrar-sesion', [ AuthController::class, 'destroy' ])->name('auth.destroy');
        //Cerrar sesión

        //Checkout
        Route::get('/checkout', [ CheckoutController::class, 'index' ])->name('checkout.index');
        //Checkout
    });
});
