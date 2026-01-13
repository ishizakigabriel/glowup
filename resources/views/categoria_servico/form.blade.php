@extends('common_template')

@section('content')
<div class="profile-container">
    <div class="card card-translucent">
        <h2>{{$categoria->nome ?? 'Nova Categoria'}}</h2>
        
        <form action="{{ is_null($categoria) ? route('categorias.store') : route('categorias.update', ['categoria' => $categoria->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (!is_null($categoria))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="nome">Nome da Categoria</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: Cabelo, Maquiagem..." required value="{{ $categoria->nome ?? '' }}">
            </div>
            <div class="form-group">
                <label for="imagem">Imagem</label>
                <input type="file" class="form-control" id="imagem" name="imagem" required>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label for="cor_profundo">Cor Profunda (Fundo)</label>
                    <input type="color" class="form-control" id="cor_profundo" name="cor_profundo" value="{{ $categoria->cor_profundo ?? '#1E1A20' }}" style="height: 50px; width: 100%; padding: 6px; cursor: pointer;" title="Misturada com grafite carbono">
                </div>
                <div class="form-col">
                    <label for="cor_pastel">Cor Pastel (Ícone)</label>
                    <input type="color" class="form-control" id="cor_pastel" name="cor_pastel" value="{{ $categoria->cor_pastel ?? '#D0BCFF' }}" style="height: 50px; width: 100%; padding: 6px; cursor: pointer;" title="Para o ícone do card">
                </div>
                <div class="form-col">
                    <label for="cor_vivido">Cor Vívida (Glow)</label>
                    <input type="color" class="form-control" id="cor_vivido" name="cor_vivido" value="{{ $categoria->cor_vivido ?? '#B69DF8' }}" style="height: 50px; width: 100%; padding: 6px; cursor: pointer;" title="Sombra efeito Glow">
                </div>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Breve descrição sobre esta categoria...">{{$categoria->descricao ?? ''}}</textarea>
            </div>

            <div class="form-group" style="margin-top: 24px; align-items: center;">
                <button type="submit" class="btn-primary">Salvar Categoria</button>
            </div>
        </form>
    </div>
</div>
@endsection 
