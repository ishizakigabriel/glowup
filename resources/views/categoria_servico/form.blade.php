@extends('common_template')

@section('content')
<div class="profile-container">
    <div class="card card-translucent">
        <h2>Nova Categoria</h2>
        
        <form action="" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="nome">Nome da Categoria</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: Cabelo, Maquiagem..." required>
            </div>
            <div class="form-group">
                <label for="imagem">Imagem</label>
                <input type="file" class="form-control" id="imagem" name="imagem" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Breve descrição sobre esta categoria..."></textarea>
            </div>

            <div class="form-group" style="margin-top: 24px; align-items: center;">
                <button type="submit" class="btn-primary">Salvar Categoria</button>
            </div>
        </form>
    </div>
</div>
@endsection
