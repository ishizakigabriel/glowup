@extends('common_template')

@section('content')
<div class="profile-container">
    <div class="card card-translucent">
        <h2>CNAE - {{ $categoria->nome }}</h2>
        
        <!-- Formulário de Associação -->
        <form action="{{ route('categorias.cnaes.store', $categoria->id) }}" method="POST" style="margin-bottom: 30px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 20px;">
            @csrf
            <div class="form-group" style="margin-bottom: 0;">
                <div style="display: flex;">
                    <select name="cnae_id" id="cnae_id" class="form-control" style="border-radius: 32px 0 0 32px; flex: 1; appearance: none; -webkit-appearance: none; background-image: url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2224%22 height=%2224%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22%23E6E1E5%22 stroke-width=%222%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22><polyline points=%226 9 12 15 18 9%22></polyline></svg>'); background-repeat: no-repeat; background-position: right 8px center; padding-right: 40px; cursor: pointer;" required>
                        <option value="" style="background-color: #1E1A20;">Selecione um CNAE...</option>
                        @foreach($cnaes as $cnae)
                            <option value="{{ $cnae->id }}" style="background-color: #1E1A20;">{{ $cnae->codigo }} - {{ $cnae->descricao }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-primary" style="margin-bottom: 0; border-radius: 0 32px 32px 0;">Adicionar CNAE</button>
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
    </div>
</div>
@endsection
