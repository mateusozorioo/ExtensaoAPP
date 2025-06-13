@extends('layouts.app')

@section('title', 'Edição Hackathons')

@php
$name = "EDIÇÃO HACKATHONS DISPONÍVEIS";
$hideMenuText = true;
@endphp

@section('content')

<div class="container mt-2 mb-4">
    <div class="justify-content-between align-items-center mb-4">
        <div class="row justify-content-between">
            <a href="{{ route('hackathons-disponiveis.index') }}" class="col-2 btn btn-secondary">← Voltar</a>
            <h2 class="col-8 h3 text-center">Qual Hackathon você deseja Editar/Excluir?</h2>
            <div class="col-2"></div> <!-- Espaço vazio para centralizar -->
        </div>
    </div>

    <!-- Mensagens de sucesso/erro -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        @forelse ($hackathons as $hackathon)
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow position-relative" style="border-radius: 15px; overflow: hidden;">
                    <!-- Imagem com altura fixa (200px) e object-fit: cover para não distorcer -->
                    <img src="{{ asset($hackathon->hackathon_imagem) }}" 
                         class="card-img-top" 
                         alt="{{ $hackathon->hackathon_nome }}" 
                         style="height: 200px; object-fit: cover;">
                    
                    <!-- Overlay que aparece no hover -->
                    <div class="card-img-overlay d-flex align-items-center justify-content-center overlay-hover" 
                         style="background: rgba(0,0,0,0.7); opacity: 0; transition: opacity 0.3s ease;">
                        
                        <!-- Botão Editar -->
                        <a href="{{ route('hackathons-disponiveis.edit', $hackathon->hackathons_disponiveis_id) }}" 
                           class="btn btn-warning btn-lg me-3">
                            ✏️
                        </a>
                        
                        <!-- Botão Excluir -->
                        <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $hackathon->hackathons_disponiveis_id }}">
                            ❌
                        </button>
                    </div>
                    
                    <div class="card-body text-center bg-secondary">
                        <h5 class="card-title text-light mb-0">{{ strtoupper($hackathon->hackathon_nome) }}</h5>
                    </div>
                </div>

                <!-- Modal de confirmação de exclusão -->
                <!-- Se o ID do hackathon é 5, vira: id="deleteModal5" -->
                <!-- O aria-labelledby conecta o modal com seu título para leitores de tela (acessibilidade) -->
                <div class="modal fade" id="deleteModal{{ $hackathon->hackathons_disponiveis_id }}" tabindex="-1"
                     aria-labelledby="deleteModalLabel{{ $hackathon->hackathons_disponiveis_id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-center w-100"
                                    id="deleteModalLabel{{ $hackathon->hackathons_disponiveis_id }}">
                                    Confirmar Exclusão</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Fechar"></button>
                            </div>
                            <div class="modal-body text-center">
                                Tem certeza que deseja excluir o hackathon
                                <strong>{{ $hackathon->hackathon_nome }}</strong> permanentemente?
                            </div>
                            <div class="modal-footer justify-content-center">
                                <form action="{{ route('hackathons-disponiveis.destroy', $hackathon->hackathons_disponiveis_id) }}"
                                      method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Não</button>
                                    <button type="submit" class="btn btn-danger">Sim</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    <h4>Nenhum hackathon disponível para editar</h4>
                    <p>Adicione hackathons na tela principal.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
<!-- No elemento com classe .card -->
<!-- Quando houver hover (mouse em cima) -->
<!-- Elemento filho com classe .overlay-hover -->
<style>
.card:hover .overlay-hover {
    opacity: 1 !important;
}
</style>

@endsection