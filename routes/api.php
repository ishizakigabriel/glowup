<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaServicoController;
use App\Http\Controllers\EstabelecimentoController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\AgendamentoController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/status', function () {
    return response()->json([
        'status' => 'online',
        'message' => 'Backend Laravel conectado com sucesso!'
    ]);
});

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/estabelecimento/{estabelecimento}/lock-horario', [AgendamentoController::class, 'lockHorario']);
    Route::get('/agendamentos', [AgendamentoController::class, 'meusAgendamentos']);
    Route::get('/agendamentos/{agendamento}', [AgendamentoController::class, 'detalhesAgendamento']);
    Route::get('/agendamentos/{agendamento}/confirmar', [AgendamentoController::class, 'confirmarAgendamento']);
    Route::get('/agendamentos/{agendamento}/cancelar', [AgendamentoController::class, 'cancelarAgendamento']);
});

Route::post('/login', [AuthController::class, 'loginMobile']);
Route::post('/register', [AuthController::class, 'registerMobile']);

Route::get('/categorias-servico', [CategoriaServicoController::class, 'categorias']);
Route::post('/categorias-servico/{categoria}/estabelecimentos', [EstabelecimentoController::class, 'estabelecimentosCategoria']);
Route::post('/estabelecimento/{estabelecimento}/servicos', [ServicoController::class, 'servicosEstabelecimento']);
Route::post('/estabelecimento/{estabelecimento}/horarios-disponiveis', [AgendamentoController::class, 'horariosDisponiveis']);

Route::get('/teste/{estabelecimento}', [ServicoController::class, 'teste']);

