@extends('common_template')
@section('content')
<div class="profile-container">
    <div class="card card-translucent">
        <h2>Categorias de Serviço</h2>

        <div style="margin-top: 20px;">
            @foreach($categorias as $categoria)
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                    <div style="display: flex; align-items: center;">
                        @if($categoria->imagem)
                            <img src="{{ asset('storage/categorias/'.$categoria->imagem) }}" alt="{{ $categoria->nome }}" style="width: 56px; height: 56px; object-fit: cover; border-radius: 8px; margin-right: 16px;">
                        @endif
                        <div>
                            <h3 style="margin: 0; font-size: 1.1rem; font-weight: 500;">{{ $categoria->nome }}</h3>
                            <p style="margin: 4px 0 0; font-size: 0.9rem; opacity: 0.8;">{{ $categoria->descricao }}</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('categorias.edit', $categoria->id) }}" style="color: inherit; text-decoration: none;" title="Editar"><span class="material-symbols-outlined">edit</span></a>
                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0;" title="Excluir"><span class="material-symbols-outlined">delete</span></button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="margin-top: 24px; text-align: center;">
            <a href="{{ route('categorias.create') }}" class="btn-primary" style="text-decoration: none; display: inline-block; width: auto;">Nova Categoria</a>
        </div>
    </div>
</div>
@endsection