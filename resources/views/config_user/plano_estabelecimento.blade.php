@extends('common_template')
@section('content')
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 80vh; padding: 40px 20px;">
        <h2 style="margin-bottom: 40px; color: var(--md-sys-color-on-surface); text-align: center;">Escolha o plano ideal</h2>

        <div style="width: 100%; display: flex; flex-direction: column; align-items: center;">

            <div style="display: flex; gap: 24px; flex-wrap: wrap; justify-content: center; margin-bottom: 40px; width: 100%;">
                
                <!-- Plano Gratuito -->
                <div class="plan-card" onclick="selectPlan('free', this)" style="padding: 32px; border-radius: 16px; width: 280px; display: flex; flex-direction: column; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 2px solid transparent; transition: all 0.3s ease; cursor: pointer;">
                    <h3 style="margin: 0 0 16px 0; color: var(--md-sys-color-on-surface); font-size: 1.5rem; text-align: center;">Gratuito</h3>
                    <div style="font-size: 2.5rem; font-weight: bold; color: var(--md-sys-color-primary); margin-bottom: 24px; text-align: center;">R$ 0<span style="font-size: 1rem; color: #666; font-weight: normal;">/mês</span></div>
                    
                    <ul style="list-style: none; padding: 0; margin: 0 0 32px 0; flex-grow: 1;">
                        <li style="margin-bottom: 12px; display: flex; align-items: center; gap: 12px; color: #666;">
                            <span class="material-symbols-outlined" style="font-size: 20px; color: var(--md-sys-color-primary);">check_circle</span> 1 Colaborador
                        </li>
                        <li style="margin-bottom: 12px; display: flex; align-items: center; gap: 12px; color: #666;">
                            <span class="material-symbols-outlined" style="font-size: 20px; color: var(--md-sys-color-primary);">check_circle</span> Agenda Básica
                        </li>
                        <li style="margin-bottom: 12px; display: flex; align-items: center; gap: 12px; color: #666;">
                            <span class="material-symbols-outlined" style="font-size: 20px; color: var(--md-sys-color-primary);">check_circle</span> Perfil no App
                        </li>
                    </ul>
                    
                    <a href="{{route('escolher_plano_submit', ['plano' => 3])}}" class="btn-select" style="text-decoration: none; width: 100%; pointer-events: none;">
                        <md-filled-tonal-button disabled style="width: 100%;">Selecionar</md-filled-tonal-button>
                    </a>
                </div>

                <!-- Plano Prata -->
                <div class="plan-card" onclick="selectPlan('silver', this)" style="padding: 32px; border-radius: 16px; width: 280px; display: flex; flex-direction: column; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 2px solid transparent; transition: all 0.3s ease; cursor: pointer; position: relative;">
                    <div style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary); padding: 4px 16px; border-radius: 100px; font-size: 0.8rem; font-weight: bold;">RECOMENDADO</div>
                    <h3 style="margin: 0 0 16px 0; color: var(--md-sys-color-on-surface); font-size: 1.5rem; text-align: center;">Prata</h3>
                    <div style="font-size: 2.5rem; font-weight: bold; color: var(--md-sys-color-primary); margin-bottom: 24px; text-align: center;">R$ 49<span style="font-size: 1rem; color: #666; font-weight: normal;">/mês</span></div>
                    
                    <ul style="list-style: none; padding: 0; margin: 0 0 32px 0; flex-grow: 1;">
                        <li style="margin-bottom: 12px; display: flex; align-items: center; gap: 12px; color: #666;">
                            <span class="material-symbols-outlined" style="font-size: 20px; color: var(--md-sys-color-primary);">check_circle</span> Até 5 Colaboradores
                        </li>
                        <li style="margin-bottom: 12px; display: flex; align-items: center; gap: 12px; color: #666;">
                            <span class="material-symbols-outlined" style="font-size: 20px; color: var(--md-sys-color-primary);">check_circle</span> Agenda Completa
                        </li>
                        <li style="margin-bottom: 12px; display: flex; align-items: center; gap: 12px; color: #666;">
                            <span class="material-symbols-outlined" style="font-size: 20px; color: var(--md-sys-color-primary);">check_circle</span> Relatórios Básicos
                        </li>
                    </ul>

                    <a href="{{route('escolher_plano_submit', ['plano' => 4])}}" class="btn-select" style="text-decoration: none; width: 100%; pointer-events: none;">
                        <md-filled-tonal-button disabled style="width: 100%;">Selecionar</md-filled-tonal-button>
                    </a>
                </div>

                <!-- Plano Ouro -->
                <div class="plan-card" onclick="selectPlan('gold', this)" style=" padding: 32px; border-radius: 16px; width: 280px; display: flex; flex-direction: column; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 2px solid transparent; transition: all 0.3s ease; cursor: pointer;">
                    <h3 style="margin: 0 0 16px 0; color: var(--md-sys-color-on-surface); font-size: 1.5rem; text-align: center;">Ouro</h3>
                    <div style="font-size: 2.5rem; font-weight: bold; color: var(--md-sys-color-primary); margin-bottom: 24px; text-align: center;">R$ 99<span style="font-size: 1rem; color: #666; font-weight: normal;">/mês</span></div>
                    
                    <ul style="list-style: none; padding: 0; margin: 0 0 32px 0; flex-grow: 1;">
                        <li style="margin-bottom: 12px; display: flex; align-items: center; gap: 12px; color: #666;">
                            <span class="material-symbols-outlined" style="font-size: 20px; color: var(--md-sys-color-primary);">check_circle</span> Colaboradores Ilimitados
                        </li>
                        <li style="margin-bottom: 12px; display: flex; align-items: center; gap: 12px; color: #666;">
                            <span class="material-symbols-outlined" style="font-size: 20px; color: var(--md-sys-color-primary);">check_circle</span> Gestão Financeira
                        </li>
                        <li style="margin-bottom: 12px; display: flex; align-items: center; gap: 12px; color: #666;">
                            <span class="material-symbols-outlined" style="font-size: 20px; color: var(--md-sys-color-primary);">check_circle</span> Suporte Prioritário
                        </li>
                    </ul>

                    <a href="{{route('escolher_plano_submit', ['plano' => 5])}}" class="btn-select" style="text-decoration: none; width: 100%; pointer-events: none;">
                        <md-filled-tonal-button disabled style="width: 100%;">Selecionar</md-filled-tonal-button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectPlan(plan, element) {
            document.querySelectorAll('.plan-card').forEach(card => {
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