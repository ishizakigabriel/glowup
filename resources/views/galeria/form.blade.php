@extends('common_template')

@section('content')
<style>
    /* Remove as setas padrão (spinners) dos inputs do tipo number */
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }
    input[type=number] {
        -moz-appearance: textfield; /* Para Firefox */
    }

    @media (min-width: 601px) {
        .col-fixed-15 {
            flex: 0 0 15%;
        }
    }
</style>
<div class="profile-container">
    <div class="card card-translucent">
        <h2>{{ isset($foto) ? 'Editar Foto' : 'Nova Foto' }}</h2>
        
        <form action="{{ is_null($foto) ? route('fotos.store') : route('fotos.update', ['foto' => $foto->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (!is_null($foto))
                @method('PUT')
            @endif

            <div class="form-row">
                <div class="form-col">
                    <label for="imagem">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*" {{ is_null($foto) ? 'required' : '' }}>
                    @if(isset($foto) && $foto->imagem)
                        <div style="margin-top: 8px;">
                            <small style="color: var(--md-sys-color-on-surface); opacity: 0.7;">
                                Imagem atual cadastrada
                            </small>
                        </div>
                    @endif
                </div>
                <div class="form-col col-fixed-15">
                    <label for="ordem">Ordem</label>
                    <input type="number" class="form-control" id="ordem" name="ordem" value="{{ $foto->ordem ?? 1 }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Breve descrição da foto...">{{ $foto->descricao ?? '' }}</textarea>
            </div>

            <div class="form-group" style="margin-top: 24px; align-items: center;">
                <button type="submit" class="btn-primary">Salvar Foto</button>
            </div>
        </form>
    </div>
</div>
@endsection
