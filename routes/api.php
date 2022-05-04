<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\ManifestoAutorizacaoController;
use App\Http\Controllers\ManifestoCiotController;
use App\Http\Controllers\ManifestoCondutorController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\PaisController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::resource('paises', PaisController::class);
Route::resource('estados', EstadoController::class);
Route::resource('municipios', MunicipioController::class);
Route::resource('empresas', EmpresaController::class);

Route::resource('autorizacaos', ManifestoAutorizacaoController::class)->only([
    'store',
    'destroy'
]);

Route::resource('ciots', ManifestoCiotController::class)->only([
    'store',
    'destroy'
]);

Route::resource('condutors', ManifestoCondutorController::class)->only([
    'store',
    'destroy'
]);

