<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\MunicipioController;

use App\Http\Controllers\ManifestoAutorizacaoController;
use App\Http\Controllers\ManifestoCiotController;
use App\Http\Controllers\ManifestoCondutorController;
use App\Http\Controllers\ManifestoContratanteController;
use App\Http\Controllers\ManifestoCteController;
use App\Http\Controllers\ManifestoLacreController;
use App\Http\Controllers\ManifestoMunicipioCarregamentoController;
use App\Http\Controllers\ManifestoMunicipioDescarregamentoController;
use App\Http\Controllers\ManifestoNfeController;
use App\Http\Controllers\ManifestoPedagioController;
use App\Http\Controllers\ManifestoPercursoEstadoController;
use App\Http\Controllers\ManifestoSeguroAverbacaoController;
use App\Http\Controllers\ManifestoSeguroController;

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


//Route::resource('paises', PaisController::class);
// Route::resource('estados', EstadoController::class);
// Route::resource('municipios', MunicipioController::class);
 //Route::resource('empresas', EmpresaController::class);

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

Route::resource('contratantes', ManifestoContratanteController::class)->only([
    'store',
    'destroy'
]);

Route::resource('ctes', ManifestoCteController::class)->only([
    'store',
    'destroy'
]);

Route::resource('lacres', ManifestoLacreController::class)->only([
    'store',
    'destroy'
]);

Route::resource('municipio-carregamentos', ManifestoMunicipioCarregamentoController::class)->only([
    'store',
    'destroy'
]);

Route::resource('municipio-descarregamentos', ManifestoMunicipioDescarregamentoController::class)->only([
    'store',
    'destroy'
]);

Route::resource('nfes', ManifestoNfeController::class)->only([
    'store',
    'destroy'
]);

Route::resource('pedagios', ManifestoPedagioController::class)->only([
    'store',
    'destroy'
]);

Route::resource('percurso-estados', ManifestoPercursoEstadoController::class)->only([
    'store',
    'destroy'
]);

Route::resource('seguros', ManifestoSeguroController::class)->only([
    'store',
    'destroy'
]);

Route::resource('seguro-averbacaos', ManifestoSeguroAverbacaoController::class)->only([
    'store',
    'destroy'
]);

Route::get('seguro-averbacao/{manifesto}/{seguro}', [ManifestoSeguroAverbacaoController::class,'list']);






