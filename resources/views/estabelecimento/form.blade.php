@extends('common_template')

@section('content')
<div class="profile-container">
    <div class="card card-translucent">
        <h2>{{ $estabelecimento->nome ?? 'Novo Estabelecimento' }}</h2>
        
        <form action="{{ is_null($estabelecimento) ? route('estabelecimentos.store') : route('estabelecimentos.update', ['estabelecimento' => $estabelecimento->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (!is_null($estabelecimento))
                @method('PUT')
            @endif
            <!-- Nome -->
            <div class="form-group">
                <label for="nome">Nome do Estabelecimento</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: Studio Glow" required value="{{ old('nome', $estabelecimento->nome ?? '') }}">
            </div>

            <div class="form-group">
                <label for="cnpj">CNPJ</label>
                <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="00.000.000/0000-00" required value="{{ old('cnpj', $estabelecimento->cnpj ?? '') }}">
            </div>

            <div class="form-group">
                <label for="logo">Logotipo</label>
                <input type="file" class="form-control" id="logo" name="logo" {{ is_null($estabelecimento) ? 'required' : '' }}>
            </div>

            <!-- CEP e Logradouro -->
            <div class="form-row">
                <div class="form-col" style="flex: 0 0 140px;">
                    <label for="cep">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000" maxlength="9" required value="{{ old('cep', $estabelecimento->cep ?? '') }}">
                </div>
                <div class="form-col">
                    <label for="logradouro">Logradouro</label>
                    <input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Rua, Avenida..." required value="{{ old('logradouro', $estabelecimento->logradouro ?? '') }}">
                </div>
            </div>

            <!-- Número e Complemento -->
            <div class="form-row">
                <div class="form-col" style="flex: 0 0 100px;">
                    <label for="numero">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero" placeholder="123" required value="{{ old('numero', $estabelecimento->numero ?? '') }}">
                </div>
                <div class="form-col">
                    <label for="complemento">Complemento</label>
                    <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Apto, Bloco, Sala..." value="{{ old('complemento', $estabelecimento->complemento ?? '') }}">
                </div>
            </div>

            <!-- Bairro, Cidade e Estado -->
            <div class="form-row">
                <div class="form-col">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" required value="{{ old('bairro', $estabelecimento->bairro ?? '') }}">
                </div> 
                <div class="form-col">
                    <label for="cidade">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" required value="{{ old('cidade', $estabelecimento->cidade ?? '') }}">
                </div>
                <div class="form-col" style="flex: 0 0 80px;">
                    <label for="estado">UF</label>
                    <input type="text" class="form-control" id="estado" name="estado" placeholder="UF" maxlength="2" required value="{{ old('estado', $estabelecimento->estado ?? '') }}">
                </div>
            </div>

            <!-- Contato -->
            <div class="form-row">
                <div class="form-col">
                    <label for="telefone">Telefone</label>
                    <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="(11) 99999-9999" required value="{{ old('telefone', $estabelecimento->telefone ?? '') }}">
                </div>
                <div class="form-col">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="contato@exemplo.com" required value="{{ old('email', $estabelecimento->email ?? '') }}">
                </div>
            </div>

            <div class="form-group" style="margin-top: 24px; flex-direction: row; justify-content: flex-end; gap: 10px; padding-right: 15px;">
                @if(!is_null($estabelecimento))
                    <a href="{{ route('verificar_perfil') }}" class="btn-primary" style="background-color: var(--md-sys-color-secondary); text-decoration: none; display: inline-block; text-align: center;">Verificar CNPJ</a>
                @endif
                <button type="submit" class="btn-primary">Salvar Perfil</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cepInput = document.getElementById('cep');
        
        cepInput.addEventListener('blur', function() {
            let cep = this.value.replace(/\D/g, '');
            
            if (cep.length === 8) {
                // Feedback visual de carregamento
                const fields = ['logradouro', 'bairro', 'cidade', 'estado'];
                fields.forEach(id => document.getElementById(id).style.opacity = '0.5');

                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            document.getElementById('logradouro').value = data.logradouro;
                            document.getElementById('bairro').value = data.bairro;
                            document.getElementById('cidade').value = data.localidade;
                            document.getElementById('estado').value = data.uf;
                            
                            // Foca no número após preencher
                            document.getElementById('numero').focus();
                        } else {
                            alert('CEP não encontrado.');
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar CEP:', error);
                    })
                    .finally(() => {
                        fields.forEach(id => document.getElementById(id).style.opacity = '1');
                    });
            }
        });
    });
</script>
@endsection
