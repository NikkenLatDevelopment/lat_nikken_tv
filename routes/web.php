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
//Seleccionar país

Route::middleware([ DetermineUserLocation::class ])->group(function () {
    //Inicio //TODO: !!!! Pendiente
    Route::get('/', function () { echo 'Hello World - home'; })->name('home');
    //Inicio //TODO: !!!! Pendiente

    //Iniciar Sesión //TODO: !!!! Pendiente
    Route::get('/iniciar-sesion', function () { echo 'Hello World - login'; })->name('login');
    //Iniciar Sesión //TODO: !!!! Pendiente

    //Registro //TODO: !!!! Pendiente
    Route::get('/registrarme', function () { echo 'Hello World - auth.create'; })->name('auth.create');
    //Registro //TODO: !!!! Pendiente

    //Contacto //TODO: !!!! Pendiente
    Route::get('/contacto', function () { echo 'Hello World - contact.show'; })->name('contact.show');
    //Contacto //TODO: !!!! Pendiente

    //Buscar producto //TODO: !!!! Pendiente
    Route::get('/buscar/{search}', function () { echo 'Hello World - search.show'; })->name('search.show');
    //Buscar producto //TODO: !!!! Pendiente

    //Campaña //TODO: !!!! Pendiente
    Route::get('/campana/{campaignSlug}', function () { echo 'Hello World - campaign.show'; })->name('campaign.show');
    //Campaña //TODO: !!!! Pendiente

    //Repuestos y Piezas //TODO: !!!! Pendiente
    Route::get('/productos/repuestos-piezas', function () { echo 'Hello World - replacement.index'; })->name('replacement.index');
    //Repuestos y Piezas //TODO: !!!! Pendiente

    //Repuestos y Piezas //TODO: !!!! Pendiente
    Route::get('/productos/eventos', function () { echo 'Hello World - event.index'; })->name('event.index');
    //Repuestos y Piezas //TODO: !!!! Pendiente

    //Repuestos y Piezas //TODO: !!!! Pendiente
    Route::get('/productos/herramientas', function () { echo 'Hello World - tool.index'; })->name('tool.index');
    //Repuestos y Piezas //TODO: !!!! Pendiente

    //Categoría //TODO: !!!! Pendiente
    Route::get('/productos/{brandSlug}', function () { echo 'Hello World - category.show'; })->name('category.show');
    //Categoría //TODO: !!!! Pendiente

    //Producto
    Route::get('/productos/{brandSlug}/{productSlug}', [ ProductController::class, 'show' ])->name('product.show');
    //Producto

    //Productos //TODO: !!!! Pendiente
    Route::get('/productos', function () { echo 'Hello World - product.index'; })->name('product.index');
    //Productos //TODO: !!!! Pendiente

    //Eliminar // ! TODO: !!!! Eliminar
    Route::get('/temporal', [ TemporalController::class, 'index' ]);
    Route::get('/temporal/logout', [ TemporalController::class, 'logout' ]);
    //Eliminar // ! TODO: !!!! Eliminar

    Route::middleware('auth')->group(function() {
        //Cerrar sesión
        Route::get('/cerrar-sesion', [ AuthController::class, 'destroy' ])->name('auth.destroy');
        //Cerrar sesión

        //Checkout
        Route::get('/checkout', [ CheckoutController::class, 'index' ])->name('checkout.index');
        //Checkout
    });
});
