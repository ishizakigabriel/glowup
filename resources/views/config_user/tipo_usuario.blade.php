@extends('common_template')
@section('content')
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 80vh;">
        <h2 style="margin-bottom: 40px; color: var(--md-sys-color-on-surface);">Selecione seu perfil</h2>

        <div style="width: 100%; display: flex; flex-direction: column; align-items: center;">

            <div style="display: flex; gap: 24px; flex-wrap: wrap; justify-content: center; margin-bottom: 40px;">
                <!-- Card Cliente -->
                <div class="selection-card" onclick="selectProfile(2, this)" style="padding: 32px; border-radius: 16px; width: 200px; text-align: center; cursor: pointer; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 2px solid transparent; transition: all 0.3s ease;">
                    <span class="material-symbols-outlined" style="font-size: 64px; color: var(--md-sys-color-primary); margin-bottom: 16px;">person</span>
                    <h3 style="margin: 0 0 8px 0; color: var(--md-sys-color-on-surface);">Cliente</h3>
                    <p style="margin: 0; color: #666; font-size: 0.9rem;">Busco serviços de beleza</p>
                    <a href="{{route('escolher_tipo_usuario_submit', ['tipo' => 2])}}" class="btn-select" style="text-decoration: none; width: 100%; pointer-events: none; margin-top: 24px;">
                        <md-filled-tonal-button disabled style="width: 100%;">Continuar</md-filled-tonal-button>
                    </a>
                </div>

                <!-- Card Estabelecimento -->
                <div class="selection-card" onclick="selectProfile(3, this)" style="padding: 32px; border-radius: 16px; width: 200px; text-align: center; cursor: pointer; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 2px solid transparent; transition: all 0.3s ease;">
                    <span class="material-symbols-outlined" style="font-size: 64px; color: var(--md-sys-color-primary); margin-bottom: 16px;">store</span>
                    <h3 style="margin: 0 0 8px 0; color: var(--md-sys-color-on-surface);">Estabelecimento</h3>
                    <p style="margin: 0; color: #666; font-size: 0.9rem;">Ofereço serviços de beleza</p>
                    <a href="{{route('escolher_tipo_usuario_submit', ['tipo' => 3])}}" class="btn-select" style="text-decoration: none; width: 100%; pointer-events: none; margin-top: 24px;">
                        <md-filled-tonal-button disabled style="width: 100%;">Continuar</md-filled-tonal-button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectProfile(type, element) {
            document.querySelectorAll('.selection-card').forEach(card => {
                card.style.borderColor = 'transparent';
                card.style.backgroundColor = '#FFFFFF22';
                card.style.transform = 'scale(1)';
                
                const link = card.querySelector('.btn-select');
                link.style.pointerEvents = 'none';
                link.querySelector('md-filled-tonal-button').setAttribute('disabled', 'true');
            });
            element.style.borderColor = 'var(--md-sys-color-primary)';
            element.style.backgroundColor = '#FFF0F555';
            element.style.transform = 'scale(1.05)';            
            
            const activeLink = element.querySelector('.btn-select');
            activeLink.style.pointerEvents = 'auto';
            activeLink.querySelector('md-filled-tonal-button').removeAttribute('disabled');
        }
    </script>
@endsection