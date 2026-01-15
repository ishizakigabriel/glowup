@extends('common_template')
@section('content')
<div class="profile-container">
    <div class="card card-translucent">
        <h2>Capacitação - {{ $servico->nome }}</h2>
        
        <form action="{{ route('colaboradores_capacitados.store', $servico->id) }}" method="POST" style="margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid rgba(255,255,255,0.1);">
            @csrf
            <div class="form-group" style="margin-bottom: 0;">
                <div style="display: flex;">
                    <select name="colaborador_id" id="colaborador_id" class="form-control" style="border-radius: 32px 0 0 32px; flex: 1; appearance: none; -webkit-appearance: none; background-image: url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2224%22 height=%2224%22 viewBox=%220 0 24 24%22 fill=%22none%22 stroke=%22%23E6E1E5%22 stroke-width=%222%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22><polyline points=%226 9 12 15 18 9%22></polyline></svg>'); background-repeat: no-repeat; background-position: right 8px center; padding-right: 40px; cursor: pointer;" required>
                        <option value="" style="color: #121212;">Selecione um colaborador...</option>
                        @foreach($colaboradores as $colaborador)
                            @if(!$colaboradoresCapacitados->contains('id', $colaborador->id))
                                <option value="{{ $colaborador->id }}" style="color: #121212;">{{ $colaborador->nome }}</option>
                            @endif
                        @endforeach
                    </select>
                    <button type="submit" class="btn-primary" style="margin-bottom: 0; border-radius: 0 32px 32px 0;">Adicionar colaborador</button>
                </div>
            </div>
        </form>

        <h3 style="font-size: 1.1rem; margin-bottom: 16px; color: var(--md-sys-color-on-surface);">Colaboradores Habilitados</h3>

        <div style="margin-top: 10px;">
            @foreach($colaboradoresCapacitados as $colaborador)
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                    <div style="display: flex; align-items: center;">
                        @if($colaborador->foto)
                            <img src="{{ asset('storage/colaboradores/'.$colaborador->foto) }}" alt="{{ $colaborador->nome }}" style="width: 48px; height: 48px; object-fit: cover; border-radius: 50%; margin-right: 16px;">
                        @else
                            <div style="width: 48px; height: 48px; background-color: rgba(255,255,255,0.1); border-radius: 50%; margin-right: 16px; display: flex; align-items: center; justify-content: center;">
                                <span class="material-symbols-outlined" style="font-size: 20px; opacity: 0.7;">person</span>
                            </div>
                        @endif
                        <div>
                            <h3 style="margin: 0; font-size: 1rem; font-weight: 500;">{{ $colaborador->nome }}</h3>
                            <p style="margin: 2px 0 0; font-size: 0.85rem; opacity: 0.8;">
                                {{ $colaborador->especialidades ?? 'Profissional' }}
                            </p>
                        </div>
                    </div>
                    
                    <form action="{{ route('colaboradores_capacitados.destroy', ['servico' => $servico->id, 'colaborador' => $colaborador->id]) }}" method="POST" onsubmit="return confirm('Remover este colaborador do serviço?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: var(--md-sys-color-error); cursor: pointer; padding: 8px;" title="Remover"><span class="material-symbols-outlined">delete</span></button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection