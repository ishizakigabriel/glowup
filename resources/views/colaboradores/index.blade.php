@extends('common_template')
@section('content')
<div class="profile-container">
    <div class="card card-translucent">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Colaboradores</h2>
            @if(isset($maxColaboradores))
                <span style="font-size: 0.9rem; opacity: 0.8;">{{ $colaboradores->count() }} / {{ $maxColaboradores }}</span>
            @endif
        </div>

        <div style="margin-top: 20px;">
            @foreach($colaboradores as $colaborador)
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                    <div style="display: flex; align-items: center;">
                        @if($colaborador->foto)
                            <img src="{{ asset('storage/colaboradores/'.$colaborador->foto) }}" alt="{{ $colaborador->nome }}" style="width: 56px; height: 56px; object-fit: cover; border-radius: 50%; margin-right: 16px;">
                        @else
                            <div style="width: 56px; height: 56px; background-color: rgba(255,255,255,0.1); border-radius: 50%; margin-right: 16px; display: flex; align-items: center; justify-content: center;">
                                <span class="material-symbols-outlined" style="font-size: 24px; opacity: 0.7;">person</span>
                            </div>
                        @endif
                        <div>
                            <h3 style="margin: 0; font-size: 1.1rem; font-weight: 500;">{{ $colaborador->nome }}</h3>
                            <p style="margin: 4px 0 0; font-size: 0.9rem; opacity: 0.8;">
                                {{ $colaborador->cargo ?? 'Profissional' }}
                            </p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('colaboradores.edit', $colaborador->id) }}" style="color: inherit; text-decoration: none;" title="Editar"><span class="material-symbols-outlined">edit</span></a>
                        <form action="{{ route('colaboradores.destroy', $colaborador->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir este colaborador?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0;" title="Excluir"><span class="material-symbols-outlined">delete</span></button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="margin-top: 24px; text-align: right;">
            @if(isset($maxColaboradores) && $colaboradores->count() >= $maxColaboradores)
                <span style="color: #ff6b6b; margin-right: 10px; font-size: 0.9rem;">Limite do plano atingido</span>
                <button class="btn-primary" style="opacity: 0.5; cursor: not-allowed;" disabled>Novo Colaborador</button>
            @else
                <a href="{{ route('colaboradores.create') }}" class="btn-primary" style="text-decoration: none; display: inline-block; width: auto;">Novo Colaborador</a>
            @endif
        </div>
    </div>
</div>
@endsection
