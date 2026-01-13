@extends('common_template')
@section('content')
<style>
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-top: 24px;
        margin-bottom: 32px;
    }

    .gallery-item {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.2s, border-color 0.2s;
    }

    .gallery-item:hover {
        transform: translateY(-4px);
        border-color: var(--md-sys-color-primary);
    }

    .gallery-img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        display: block;
    }

    .gallery-actions {
        padding: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: rgba(0, 0, 0, 0.3);
    }

    .btn-icon {
        background: none;
        border: none;
        color: var(--md-sys-color-on-surface);
        cursor: pointer;
        padding: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s;
    }

    .btn-icon:hover {
        color: var(--md-sys-color-primary);
    }

    .btn-icon.delete:hover {
        color: var(--md-sys-color-error);
    }

    @media (max-width: 768px) {
        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 480px) {
        .gallery-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="profile-container">
    <div class="card card-translucent">
        @php
            $user = auth()->user();
            $maxFotos = match($user->UAC ?? 3) {
                3 => 1,   // Plano Básico
                4 => 3,   // Plano Prata
                5 => 6,   // Plano Ouro
                default => 1
            };
            $fotosCount = isset($fotos) ? count($fotos) : 0;
        @endphp

        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="margin: 0;">Galeria</h2>
            <span style="font-size: 0.9rem; opacity: 0.8; background: rgba(255,255,255,0.1); padding: 4px 12px; border-radius: 12px;">
                {{ $fotosCount }} / {{ $maxFotos }} fotos
            </span>
        </div>

        @if(session('success'))
            <div class="alert alert-success" style="margin-top: 20px;">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" style="margin-top: 20px;">{{ session('error') }}</div>
        @endif

        <div class="gallery-grid">
            @if(isset($fotos) && count($fotos) > 0)
                @foreach($fotos as $foto)
                    <div class="gallery-item">
                        <img src="{{ asset('storage/fotos/' . ($foto->foto ?? $foto->imagem)) }}" alt="{{ $foto->descricao }}" class="gallery-img">
                        <div class="gallery-actions">
                            <span style="font-size: 0.8rem; opacity: 0.7;">Ordem: {{ $foto->ordem }}</span>
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('fotos.edit', $foto->id) }}" class="btn-icon" title="Editar">
                                    <span class="material-symbols-outlined" style="font-size: 20px;">edit</span>
                                </a>
                                <form action="{{ route('fotos.destroy', $foto->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon delete" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir esta foto?')">
                                        <span class="material-symbols-outlined" style="font-size: 20px;">delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; opacity: 0.6;">
                    <span class="material-symbols-outlined" style="font-size: 48px; margin-bottom: 16px;">photo_library</span>
                    <p>Nenhuma foto cadastrada.</p>
                </div>
            @endif
        </div>

        <div style="text-align: center;">
            @if($fotosCount < $maxFotos)
                <a href="{{ route('fotos.create') }}" class="btn-primary" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                    <span class="material-symbols-outlined">add_photo_alternate</span>
                    Inserir outra foto
                </a>
            @else
                <button class="btn-primary" style="opacity: 0.5; cursor: not-allowed; display: inline-flex; align-items: center; gap: 8px;" disabled>
                    <span class="material-symbols-outlined">lock</span>
                    Limite atingido
                </button>
                <p style="margin-top: 12px; font-size: 0.9rem; color: var(--md-sys-color-error);">
                    Você atingiu o limite de fotos do seu plano.
                </p>
            @endif
        </div>
    </div>
</div>
@endsection