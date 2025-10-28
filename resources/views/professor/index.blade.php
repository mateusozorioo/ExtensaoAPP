@extends('layouts.app')

@section('title', 'Menu - Professor')

@section('content')

@php
$name = "MENU DO PROFESSOR";
@endphp

<div class="container mt-3 mb-4">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        {{-- Card 1: Hackathons UNIFIL --}}
        <div class="col">
            <a href="{{ route('hackathons-disponiveis.index') }}" class="text-decoration-none">
                <div class="card bg-secondary text-white shadow-lg">
                    <div class="card-body d-flex align-items-center py-5">
                        <div class="me-3">
                            <!-- Ícone aqui -->
                            <div class="bg-info rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <!-- <i class="bi bi-trophy"></i> -->
                                <img src="{{ asset('images/trophy.png') }}" width="40" class="img-fluid" alt="Icon-Trofeu">
                            </div>
                        </div>
                        <div>
                            <h5 class="card-title text-warning">HACKATHONS UNIFIL</h5>
                            <p class="card-text">Verifique os Hackathons disponíveis para alunos.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Card 2: Gerenciar Grade Horária --}}
        <div class="col">
            <a href="{{ route('materia.index') }}" class="text-decoration-none">
                <div class="card bg-secondary text-white h-100 shadow-lg">
                    <div class="card-body d-flex align-items-center py-5">
                        <div class="me-3">
                            <!-- Ícone aqui -->
                            <div class="bg-info rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <!-- <i class="bi bi-calendar"></i> -->
                                <img src="{{ asset('images/prancheta.png') }}" width="40" class="img-fluid" alt="Icon-Prancheta">
                            </div>
                        </div>
                        <div>
                            <h5 class="card-title text-warning">GERENCIAR MATÉRIAS</h5>
                            <p class="card-text">Gerencie todas as matérias.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Card 3: Gerenciar seus alunos --}}
        <div class="col">
            <a href="{{ route ('turmas.index') }}" class="text-decoration-none">
                <div class="card bg-secondary text-white h-100 shadow-lg">
                    <div class="card-body d-flex align-items-center py-5">
                        <div class="me-3">
                            <!-- Ícone aqui -->
                            <div class="bg-info rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <!-- <i class="bi bi-people"></i> -->
                                 <img src="{{ asset('images/graduation.png') }}" width="40" class="img-fluid" alt="Icon-Graduation">
                            </div>
                        </div>
                        <div>
                            <h5 class="card-title text-warning">GERENCIAR SEUS ALUNOS</h5>
                            <p class="card-text">Verifique os alunos inscritos em suas matérias.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Card 4: Validar Hackathons --}}
        <div class="col">
            <a href="{{ route ('solicitacoes.index') }}" class="text-decoration-none">
                <div class="card bg-secondary text-white h-100 shadow-lg">
                    <div class="card-body d-flex align-items-center py-5">
                        <div class="me-3">
                            <!-- Ícone aqui -->
                            <div class="bg-info rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <!-- <i class="bi bi-check-circle"></i> -->
                                 <img src="{{ asset('images/aceitar.png') }}" width="40" class="img-fluid" alt="Icon-Aceitar">
                            </div>
                        </div>
                        <div>
                            <h5 class="card-title text-warning">VALIDAR PARTICIPAÇÃO DOS ALUNOS</h5>
                            <p class="card-text">Valide as solicitações de participação em Hackathons de seus alunos!</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>


<!-- Bootstrap JS (opcional, caso queira usar interações no futuro) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection