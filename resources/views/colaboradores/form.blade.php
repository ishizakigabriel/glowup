@extends('common_template')

@section('content')
<div class="profile-container">
    <div class="card card-translucent">
        <h2>{{ $colaborador->nome ?? 'Novo Colaborador' }}</h2>
        
        <form action="{{ is_null($colaborador) ? route('colaboradores.store') : route('colaboradores.update', ['colaboradore' => $colaborador->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (!is_null($colaborador))
                @method('PUT')
            @endif
            
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do profissional" required value="{{ old('nome', $colaborador->nome ?? '') }}">
            </div>

            <div class="form-group">
                <label for="cargo">Cargo / Especialidade</label>
                <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Ex: Cabeleireiro, Manicure..." value="{{ old('cargo', $colaborador->cargo ?? '') }}">
            </div>

            <div class="form-group">
                <label for="foto">Foto de Perfil</label>
                <input type="file" class="form-control" id="foto" name="foto">
            </div>

            <div class="form-group">
                <label for="biografia">Biografia</label>
                <textarea class="form-control" id="biografia" name="biografia" rows="4" placeholder="Breve descrição sobre o profissional...">{{ old('biografia', $colaborador->biografia ?? '') }}</textarea>
            </div>

            <div class="form-group" style="margin-top: 24px; align-items: end; padding-right: 15px;">
                <button type="submit" class="btn-primary">Salvar Colaborador</button>
            </div>
        </form>
    </div>
</div>
@endsection
