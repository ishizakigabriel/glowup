@extends('common_template')

@section('content')
<div class="profile-container">
    <div class="card card-translucent">
        <h2>CNAEs - {{ $categoria->nome }}</h2>
        
        <!-- Formulário de Associação -->
        <form action="{{ route('categorias.cnaes.store', $categoria->id) }}" method="POST" style="margin-bottom: 30px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 20px;">
            @csrf
            <div class="form-group">
                <label for="cnae_id">Adicionar CNAE</label>
                <div style="display: flex; gap: 10px;">
                    <select class="form-control" id="cnae_id" name="cnae_id" required style="flex: 1;">
                        <option value="" style="background-color: #1E1A20;">Selecione um CNAE...</option>
                        @foreach($cnaes as $cnae)
                            <option value="{{ $cnae->id }}" style="background-color: #1E1A20;">{{ $cnae->codigo }} - {{ $cnae->descricao }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-primary" style="width: auto; white-space: nowrap;">Adicionar</button>
                </div>
            </div>
        </form>

        <!-- Lista de Associados -->
        <h3>CNAEs Associados</h3>
        <div style="margin-top: 20px;">
            @forelse($categoria->cnaes as $cnae)
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                    <div>
                        <h3 style="margin: 0; font-size: 1.1rem; font-weight: 500;">{{ $cnae->codigo }}</h3>
                        <p style="margin: 4px 0 0; font-size: 0.9rem; opacity: 0.8;">{{ $cnae->descricao }}</p>
                    </div>
                    
                    <form action="{{ route('categorias.cnaes.destroy', ['categoria' => $categoria->id, 'cnae' => $cnae->id]) }}" method="POST" onsubmit="return confirm('Remover este CNAE da categoria?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0;" title="Remover"><span class="material-symbols-outlined">delete</span></button>
                    </form>
                </div>
            @empty
                <p style="opacity: 0.7; text-align: center; padding: 20px;">Nenhum CNAE associado a esta categoria.</p>
            @endforelse
        </div>

        <div style="margin-top: 24px; text-align: center;">
            <a href="{{ route('categorias.index') }}" class="btn-primary" style="text-decoration: none; display: inline-block; background-color: transparent; border: 1px solid var(--md-sys-color-primary);">Voltar</a>
        </div>
    </div>
</div>
@endsection
