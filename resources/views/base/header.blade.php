<header class="app-header" id="app-header">
    <button id="sidebar-toggle" class="toggle-btn">
        <span class="material-symbols-outlined">menu</span>
    </button>

    <nav style="margin-left: auto; display: flex; gap: 20px; align-items: center; padding-right: 20px;">
        <a href="{{ route('meu_perfil') }}" style="color: #E8E9EA; text-decoration: none; font-weight: 500; font-size: 1.1rem;">Meu perfil</a>
        <a href="{{ route('fotos.index') }}" style="color: #E8E9EA; text-decoration: none; font-weight: 500; font-size: 1.1rem;">Galeria</a>
        <a href="{{ route('servicos.index') }}" style="color: #E8E9EA; text-decoration: none; font-weight: 500; font-size: 1.1rem;">Serviços</a>
        <a href="{{ route('colaboradores.index') }}" style="color: #E8E9EA; text-decoration: none; font-weight: 500; font-size: 1.1rem;">Colaboradores</a>        
    </nav>
</header>
