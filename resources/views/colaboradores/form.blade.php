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
                <label for="nome">Nome do Colaborador</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: Ana Silva" required value="{{ $colaborador->nome ?? '' }}">
            </div>

            <div class="form-group">
                <label for="especialidades">Especialidade</label>
                <input type="text" class="form-control" id="especialidades" name="especialidades" placeholder="Ex: Cabeleireira, Manicure..." value="{{ $colaborador->cargo ?? '' }}">
            </div>

            <div class="form-group">
                <label for="foto">Foto de Perfil</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                @if(isset($colaborador) && $colaborador->foto)
                    <div style="margin-top: 8px;">
                        <small style="color: var(--md-sys-color-on-surface); opacity: 0.7;">
                            Foto atual cadastrada
                        </small>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="biografia">Biografia</label>
                <textarea class="form-control" id="biografia" name="biografia" rows="4" placeholder="Breve descrição sobre o colaborador...">{{ $colaborador->biografia ?? '' }}</textarea>
            </div>

            <div class="form-group" style="margin-top: 24px; align-items: center;">
                <button type="submit" class="btn-primary">Salvar Colaborador</button>
            </div>
        </form>
    </div>
</div>
@endsection
