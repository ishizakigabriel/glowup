@extends('common_template')
@section('content')
    <div class="card" style="max-width: 400px; margin: 40px auto;">
        <h2 style="text-align: center;">Criar Conta</h2>
        
        <form action="{{ url('register') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <md-filled-text-field label="Nome" type="text" name="name" required style="width: 100%;"></md-filled-text-field>
            </div>

            <div class="form-group">
                <md-filled-text-field label="E-mail" type="email" name="email" required style="width: 100%;"></md-filled-text-field>
            </div>

            <div class="form-group">
                <md-filled-text-field label="Senha" type="password" name="password" required style="width: 100%;"></md-filled-text-field>
            </div>

            <div class="form-group">
                <md-filled-text-field label="Confirmar Senha" type="password" name="password_confirmation" required style="width: 100%;"></md-filled-text-field>
            </div>

            <div class="form-actions" style="display: flex; justify-content: center;">
                <md-filled-tonal-button type="submit" style="width: 100%;">Registrar</md-filled-tonal-button>
            </div>

            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ route('loginView') }}" style="color: var(--md-sys-color-primary); text-decoration: none;">Já tem uma conta? Faça login</a>
            </div>
        </form>
    </div>
@endsection