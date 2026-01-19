<?php
use App\Models\User;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriaServicoController;
use App\Http\Controllers\EstabelecimentoController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\EnderecoController;

Route::get('/user', function (Request $request) {
    $user = $request->user();
    $response = User::with('enderecos')->find($user->id);
    return response()->json($response, 200);
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

    Route::post('/perfil/raio_busca', [UserController::class, 'raioBusca']);
    Route::post('/perfil/aviso_24h', [UserController::class, 'aviso24h']);
    Route::post('/perfil/aviso_2h', [UserController::class, 'aviso2h']);
    Route::put('/perfil/edit_profile', [UserController::class, 'editProfile']);

    Route::resource('enderecos', EnderecoController::class);
});

Route::post('/login', [AuthController::class, 'loginMobile']);
Route::post('/register', [AuthController::class, 'registerMobile']);

Route::get('/categorias-servico', [CategoriaServicoController::class, 'categorias']);
Route::post('/categorias-servico/{categoria}/estabelecimentos', [EstabelecimentoController::class, 'estabelecimentosCategoria']);
Route::post('/estabelecimento/{estabelecimento}/servicos', [ServicoController::class, 'servicosEstabelecimento']);
Route::post('/estabelecimento/{estabelecimento}/horarios-disponiveis', [AgendamentoController::class, 'horariosDisponiveis']);

Route::get('/teste/{estabelecimento}', [ServicoController::class, 'teste']);

