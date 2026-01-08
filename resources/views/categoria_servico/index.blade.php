@extends('common_template')
@section('content')
    <div class="card">
        <h2>Categorias de Serviço</h2>

        <md-list>
            @foreach($categorias as $categoria)
                <md-list-item>
                    <div slot="headline">{{ $categoria->nome }}</div>
                    <div slot="supporting-text">{{ $categoria->descricao }}</div>
                    
                    @if($categoria->imagem)
                        <img slot="end" src="{{ asset($categoria->imagem) }}" alt="{{ $categoria->nome }}" style="width: 56px; height: 56px; object-fit: cover; border-radius: 8px;">
                    @endif
                </md-list-item>
                <md-divider></md-divider>
            @endforeach
        </md-list>
    </div>
@endsection