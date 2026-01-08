@extends('common_template')

@section('content')
    <div class="card">
        <h2>Nova Categoria de Serviço</h2>
        
        <form action="{{route('categorias.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <md-filled-text-field label="Nome" name="nome" placeholder="Ex: Cabelo, Manicure..." style="width: 100%;"></md-filled-text-field>
            </div>

            <div class="form-group">
                <md-filled-text-field label="Descrição" type="textarea" rows="3" name="descricao" placeholder="Breve descrição da categoria" style="width: 100%;"></md-filled-text-field>
            </div>

            <div class="form-group">
                <md-filled-text-field label="Imagem de capa" type="text" name="capa" style="width: 100%"></md-filled-text-field>
                <input type="file" name="imagem_capa" id="#imagem_capa" style="display: none;">
            </div>

            <div class="form-actions">
                <md-filled-tonal-button type="submit">Salvar Categoria</md-filled-tonal-button>
            </div>
        </form>
    </div>
@endsection