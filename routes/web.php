<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriaServicoController;
use App\Http\Controllers\EstabelecimentoController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\ColaboradorController;



Route::get('login', [AuthController::class, 'loginView'])->name('loginView');
Route::get('register', [AuthController::class, 'registerView'])->name('registerView');

Route::middleware('auth')->group(function(){
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/meus-servicos', [ServicoController::class, 'meusServicos']);
    Route::get('/meus-colaboradores', [ColaboradorController::class, 'meusColaboradores']);
    Route::get('/setup', [UserController::class, 'userType'])->name('choose_user_type');
    Route::get('/setup/{tipo}', [UserController::class, 'chooseUserType'])->name('escolher_tipo_usuario_submit');
    Route::get('/escolher-plano', [UserController::class, 'escolherPlano'])->name('escolher_plano');
    Route::get('/escolher-plano/{plano}', [UserController::class, 'escolherPlanoSubmit'])->name('escolher_plano_submit');
});

Route::resource('categorias', CategoriaServicoController::class);
Route::resource('estabelecimentos', EstabelecimentoController::class);
Route::resource('servicos', ServicoController::class);
Route::resource('colaboradores', ColaboradorController::class);



