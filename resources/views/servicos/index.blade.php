@extends('common_template')
@section('content')
<div class="profile-container">
    <div class="card card-translucent">
        <h2>Serviços</h2>

        <div style="margin-top: 20px;">
            @foreach($servicos as $servico)
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                    <div style="display: flex; align-items: center;">
                        @if($servico->imagem)
                            <img src="{{ asset('storage/servicos/'.$servico->imagem) }}" alt="{{ $servico->nome }}" style="width: 56px; height: 56px; object-fit: cover; border-radius: 8px; margin-right: 16px;">
                        @endif
                        <div>
                            <h3 style="margin: 0; font-size: 1.1rem; font-weight: 500;">{{ $servico->nome }}</h3>
                            <p style="margin: 4px 0 0; font-size: 0.9rem; opacity: 0.8;">
                                {{ $servico->descricao }}
                                @if($servico->preco)
                                    <span style="margin-left: 8px; font-weight: bold;">R$ {{ number_format($servico->preco, 2, ',', '.') }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('servicos.edit', $servico->id) }}" style="color: inherit; text-decoration: none;" title="Editar"><span class="material-symbols-outlined">edit</span></a>
                        <form action="{{ route('servicos.destroy', $servico->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir este serviço?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0;" title="Excluir"><span class="material-symbols-outlined">delete</span></button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="margin-top: 24px; text-align: center;">
            <a href="{{ route('servicos.create') }}" class="btn-primary" style="text-decoration: none; display: inline-block; width: auto;">Novo Serviço</a>
        </div>
    </div>
</div>
@endsection
