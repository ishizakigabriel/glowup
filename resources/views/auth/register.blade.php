@extends('common_template')
@section('content')
<div class="profile-container">
    <div class="card card-translucent" style="max-width: 400px; margin: 0 auto;">
        <h2 style="text-align: center;">Criar Conta</h2>
        
        <form action="{{ url('register') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ old() ? old('name') : '' }}">
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required value="{{ old() ? old('email') : '' }}">
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required value="{{ old() ? old('password') : '' }}">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Senha</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required value="{{ old() ? old('password_confirmation') : '' }}">
            </div>

            <div class="form-group" style="margin-top: 24px; justify-content: center;">
                <button type="submit" class="btn-primary" style="width: 100%;">Registrar</button>
            </div>

            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ route('loginView') }}" style="color: var(--md-sys-color-primary); text-decoration: none;">Já tem uma conta? Faça login</a>
            </div> 
        </form>
    </div>
</div>
@endsection