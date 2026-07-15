<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\FacturaController;

/*
Route::get('/', function () {
    //return view('welcome');
});
*/

// Cargar directamente el proyecto
Route::get('/', function () {
    return redirect()->route('facturas.index');
});

// PRUEBA 1
/*
Route::get('/clientes', function () {
    return 'Aquí va la lista de clientes';
});
*/

// PRUEBA 2 
/*
use App\Models\Cliente;
Route::get('/clientes', function () {
    $clientes = Cliente::all();
    return $clientes;
});
*/

Route::resource('clientes', ClienteController::class);
Route::resource('productos', ProductoController::class);
Route::resource('facturas', FacturaController::class);

