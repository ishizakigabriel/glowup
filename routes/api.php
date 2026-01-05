<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaServicoController;
use App\Http\Controllers\EstabelecimentoController;
use App\Http\Controllers\ServicoController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/status', function () {
    return response()->json([
        'status' => 'online',
        'message' => 'Backend Laravel conectado com sucesso!'
    ]);
});

Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);

Route::get('/categorias-servico', [CategoriaServicoController::class, 'index']);
Route::get('/categorias-servico/{categoria}/estabelecimentos', [EstabelecimentoController::class, 'estabelecimentosCategoria']);
Route::get('/estabelecimento/{estabelecimento}/servicos', [ServicoController::class, 'servicosEstabelecimento']);