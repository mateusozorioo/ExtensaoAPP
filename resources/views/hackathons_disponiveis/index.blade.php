@extends('layouts.app')

@section('title', 'Edição Hackathons')

@php
$name = "GERENCIAR HACKATHONS DISPONÍVEIS";
$hideMenuText = false;
@endphp

@section('content')
<div class="container mt-2 mb-4">
    <div class="row d-flex justify-content-between align-items-center mb-2">
        <div class="col-lg-2 mb-2">
            <a href="{{ route('hackathons-disponiveis.aluno') }}" 
            class="btn btn-info" 
            data-bs-toggle="tooltip" 
            data-bs-placement="top" 
            data-bs-title="Visualizar tela do aluno">
                👁️
            </a>
        </div>
        <div class="col-lg-3 mb-2">
            <a href="{{ route('hackathons-disponiveis.create') }}" class="shadow btn btn-success w-100">
                + Adicionar Hackathon
            </a>
        </div>
        <div class="col-lg-2 d-flex justify-content-end align-items-center">
            <div class="p-2">
                <!-- MUDANÇA: De POST para GET (link simples) -->
                <a href="{{ route('professor.home') }}" class="btn btn-outline-secondary btn-lg border-2 px-4 shadow"">
                    <i class="fa-solid fa-house"></i><i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
        <div class="row d-flex justify-content-center align-items-center mb-2">
            <!-- Título do body -->
            <h2 class="col-lg-8 h3 text-center">Escolha o Hackathon que você deseja Editar/Excluir</h2> 
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
                    <img src="{{ route('hackathons-disponiveis.imagem', $hackathon->hackathons_disponiveis_id) }}" 
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
                    
                    <div class="card-body text-center bg-secondary p-2">
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