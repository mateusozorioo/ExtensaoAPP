@extends('layouts.appAluno')

@section('title', 'Menu - Aluno')

@section('content')

@php
$name = "MENU DO ALUNO";
@endphp

<div class="container">
    <div class="row">
        <a href="{{ route('professor.home') }}" class="btn btn-info">
            Acessar Menu do Professor
        </a>
    </div>
</div>

<div class="container mt-3 mb-4">
    <div class="row row-cols-1 row-cols-md-2 g-4">
        {{-- Card 1: Hackathons UNIFIL --}}
        <div class="col">
            <a href="{{ route('alunos.hackathons') }}" class="text-decoration-none">
                <div class="card bg-secondary text-white shadow-lg">
                    <div class="card-body d-flex align-items-center py-5">
                        <div class="me-3">
                            <!-- Ícone aqui -->
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <!-- <i class="bi bi-trophy"></i> -->
                                <img src="{{ asset('images/trophy.png') }}" width="40" class="img-fluid" alt="Icon-Trofeu">
                            </div>
                        </div>
                        <div>
                            <h5 class="card-title text-warning">HACKATHONS UNIFIL</h5>
                            <p class="card-text">Verifique os Hackathons que estão disponíveis.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Card 2: Inscrever-se na matéria --}}
        <div class="col">
            <a href="{{ route('alunos.materia.index') }}" class="text-decoration-none">
                <div class="card bg-secondary text-white h-100 shadow-lg">
                    <div class="card-body d-flex align-items-center py-5">
                        <div class="me-3">
                            <!-- Ícone aqui -->
                            <div class="bg-info rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <!-- <i class="bi bi-calendar"></i> -->
                                <img src="{{ asset('images/materia.png') }}" width="40" class="img-fluid" alt="Icon-Materia">
                            </div>
                        </div>
                        <div>
                            <h5 class="card-title text-warning">INSCREVER-SE EM UMA MATÉRIA</h5>
                            <p class="card-text">Inscreva-se ou consulte sua matéria.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Card 3:  --}}
        <div class="col">
            <a href="{{ route('alunos.anulacao.index') }}" class="text-decoration-none">
                <div class="card bg-secondary text-white h-100 shadow-lg">
                    <div class="card-body d-flex align-items-center py-5">
                        <div class="me-3">
                            <!-- Ícone aqui -->
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <!-- <i class="bi bi-people"></i> -->
                                 <img src="{{ asset('images/anular.png') }}" width="40" class="img-fluid" alt="Icon-Anular">
                            </div>
                        </div>
                        <div>
                            <h5 class="card-title text-warning">ANULAR MATÉRIA (PI)</h5>
                            <p class="card-text">Anule sua matéria de PI em troca de <strong>-1</strong> crédito.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Card 4: Solicitar Validação de Hackathons --}}
        <div class="col">
            <a href="{{ route ('alunos.solicitacao.index') }}" class="text-decoration-none">
                <div class="card bg-secondary text-white h-100 shadow-lg">
                    <div class="card-body d-flex align-items-center py-5">
                        <div class="me-3">
                            <!-- Ícone aqui -->
                            <div class="bg-info rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <!-- <i class="bi bi-check-circle"></i> -->
                                 <img src="{{ asset('images/solicitacao-de-cotacao.png') }}" width="40" class="img-fluid" alt="Icon-Solicitacao">
                            </div>
                        </div>
                        <div>
                            <h5 class="card-title text-warning">SOLICITAR VALIDAÇÃO DE HACKATHONS</h5>
                            <p class="card-text">Solicite a validação do Hackathon que você fez!</p>
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