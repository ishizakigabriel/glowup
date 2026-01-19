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

    /* Estilização do Select semelhante ao Bootstrap */
    select.form-control {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
        padding-right: 2.25rem; /* Espaço para a seta */
        background-color: #fff;
        color: #212529;
    }

    /* Garante a visibilidade das opções internas do select */
    select.form-control option {
        color: #212529;
        background-color: #fff;
    }
</style>
<div class="profile-container">
    <div class="card card-translucent">
        <h2>{{ $servico->nome ?? 'Novo Serviço' }}</h2>
        @php
            $cnaesVerificados =$estabelecimento->cnaes->pluck('id')->toArray();
        @endphp        
        <form action="{{ is_null($servico) ? route('servicos.store') : route('servicos.update', ['servico' => $servico->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (!is_null($servico))
                @method('PUT')
            @endif
            
            <div class="form-group">
                <label for="nome">Nome do Serviço</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: Corte Masculino" required value="{{ old('nome', $servico->nome ?? '') }}">
            </div>
            <div class="form-row">
                <div class="form-col">
                    <label for="categoria_servico_id">Categoria</label>
                    <select class="form-control" id="categoria_servico_id" name="categoria_servico_id" required>
                        <option value="">Selecione uma categoria</option>
                        @foreach($categorias as $categoria)
                            @php
                                $cnaesVerificadosCategoria = $categoria->cnaes->pluck('id')->toArray();
                                $verificado = false;
                                foreach ($cnaesVerificadosCategoria as $cnaeVerificado) {
                                    # code...
                                    if(in_array($cnaeVerificado, $cnaesVerificados)) {
                                        $verificado = true;
                                        break;
                                    }
                                }
                            @endphp
                            <option value="{{ $categoria->id }}" {{ (isset($servico) && $servico->categoria_servico_id == $categoria->id) ? 'selected' : '' }}>
                                {{ $categoria->nome }} {{ $verificado ? '✓' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-col">
                    <label for="preco">Preço (R$)</label>
                    <input type="text" inputmode="numeric" class="form-control" id="preco" name="preco" placeholder="0,00" required value="{{ isset($servico->preco) ? number_format($servico->preco, 2, ',', '.') : '' }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label for="tempo_medio_duracao">Duração (minutos)</label>
                    <input type="number" class="form-control" id="tempo_medio_duracao" name="tempo_medio_duracao" placeholder="Ex: 30" required value="{{ old('tempo_medio_duracao', $servico->tempo_medio_duracao ?? '') }}">
                </div>
                <div class="form-col">
                    <label for="imagem">Imagem</label>
                    <input type="file" class="form-control" id="imagem" name="imagem">
                </div>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Detalhes sobre o serviço...">{{ old('descricao', $servico->descricao ?? '') }}</textarea>
            </div>

            <div class="form-group" style="margin-top: 24px; align-items: end; padding-right: 15px;">
                <button type="submit" class="btn-primary">Salvar Serviço</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const precoInput = document.getElementById('preco');
        
        precoInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            
            if (value === '') {
                e.target.value = '';
                return;
            }
            
            let number = parseFloat(value) / 100;
            
            e.target.value = number.toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        });
    });
</script>
@endsection
