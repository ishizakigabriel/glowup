@extends('common_template')
@section('content')
<div class="profile-container">
    <div class="card card-translucent" style="max-width: 400px; margin: 0 auto;">
        <h2 style="text-align: center;">Login</h2>
        
        <form action="{{ url('login') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required value="{{ old() ? old('email') : '' }}">
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required value="{{ old() ? old('password') : '' }}">
            </div>

            <div class="form-group" style="margin-top: 24px; justify-content: center;">
                <button type="submit" class="btn-primary" style="width: 100%;">Entrar</button>
            </div>

            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ route('registerView') }}" style="color: var(--md-sys-color-primary); text-decoration: none;">Criar nova conta</a>
            </div>
        </form>
    </div>
</div>
@endsection