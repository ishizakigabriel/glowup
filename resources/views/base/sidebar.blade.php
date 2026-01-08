<aside class="sidebar-fixed" id="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('images/glowup.png') }}" alt="Glow Up" style="max-width: 100%; max-height: 100px; object-fit: contain;">
    </div>

    <nav>
        <md-list>
            <md-list-item type="link" href="/dashboard">
                <span slot="start" class="material-symbols-outlined">dashboard</span>
                <span class="nav-label">Dashboard</span>
            </md-list-item>
            
            <md-list-item type="link" href="/servicos">
                <span slot="start" class="material-symbols-outlined">spa</span>
                <span class="nav-label">Serviços</span>
            </md-list-item>

            <md-list-item type="link" href="/agendamentos">
                <span slot="start" class="material-symbols-outlined">event</span>
                <span class="nav-label">Agendamentos</span>
            </md-list-item>

            <md-divider></md-divider>

            <md-list-item type="link" href="/configuracoes">
                <span slot="start" class="material-symbols-outlined">settings</span>
                <span class="nav-label">Configurações</span>
            </md-list-item>
        </md-list>
    </nav>
</aside>