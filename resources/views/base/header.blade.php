<header class="app-header" id="app-header">
    <button id="sidebar-toggle" class="toggle-btn">
        <span class="material-symbols-outlined">menu</span>
    </button>

    <nav style="margin-left: auto; display: flex; gap: 20px; align-items: center; padding-right: 20px;">
        <a href="{{ route('servicos.index') }}" style="color: #BB86FC; text-decoration: none; font-weight: 500; font-size: 1.1rem;">Serviços</a>
        <a href="{{ route('colaboradores.index') }}" style="color: #BB86FC; text-decoration: none; font-weight: 500; font-size: 1.1rem;">Colaboradores</a>
        <a href="{{ route('meu_perfil') }}" style="color: #BB86FC; text-decoration: none; font-weight: 500; font-size: 1.1rem;">Meu perfil</a>
    </nav>
</header>
