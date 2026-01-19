@extends('common_template')

@section('content')
<div class="profile-container">
    <div class="card card-translucent">
        <h2>{{ $cnae->codigo ?? 'Novo CNAE' }}</h2>
        
        <form action="{{ is_null($cnae) ? route('cnaes.store') : route('cnaes.update', ['cnae' => $cnae->id]) }}" method="POST">
            @csrf
            @if (!is_null($cnae))
                @method('PUT')
            @endif
            
            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Ex: 9602-5/01" required value="{{ old('codigo', $cnae->codigo ?? '') }}">
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Descrição da atividade..." required>{{ old('descricao', $cnae->descricao ?? '') }}</textarea>
            </div>

            <div class="form-group" style="margin-top: 24px; align-items: center;">
                <button type="submit" class="btn-primary">Salvar CNAE</button>
            </div>
        </form>
    </div>
</div>
@endsection
