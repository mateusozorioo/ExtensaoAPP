@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')

<main class="flex-grow-1">
    <div class="container mt-3 mb-4">
        <div class="row">
            <h1 class="h3 text-center mb-4 text-white bg-gradient p-3 rounded"
                style="background: linear-gradient(45deg, #ff6b35, #f7931e) !important;">MENU DO PROFESSOR
            </h1>
        </div>

        <div class="row row-cols-1 row-cols-md-2 g-4">
            {{-- Card 1: Hackathons UNIFIL --}}
            <div class="col">
                <a href="#" class="text-decoration-none">
                    <div class="card bg-secondary text-white shadow-lg">
                        <div class="card-body d-flex align-items-center py-5">
                            <div class="me-3">
                                <!-- Ícone aqui -->
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 60px; height: 60px;">
                                    <!-- <i class="bi bi-trophy"></i> -->
                                    <span>🏆</span>
                                </div>
                            </div>
                            <div>
                                <h5 class="card-title text-warning">HACKATHONS UNIFIL</h5>
                                <p class="card-text">Verifique os Hackathons disponíveis para alunos</p>
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
                                    <span>📄</span>
                                </div>
                            </div>
                            <div>
                                <h5 class="card-title text-warning">GERENCIAR MATÉRIAS</h5>
                                <p class="card-text">Gerencie todas as matérias</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Card 3: Gerenciar seus alunos --}}
            <div class="col">
                <a href="#" class="text-decoration-none">
                    <div class="card bg-secondary text-white h-100 shadow-lg">
                        <div class="card-body d-flex align-items-center py-5">
                            <div class="me-3">
                                <!-- Ícone aqui -->
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 60px; height: 60px;">
                                    <!-- <i class="bi bi-people"></i> -->
                                    <span class="text-white">🎧</span>
                                </div>
                            </div>
                            <div>
                                <h5 class="card-title text-warning">GERENCIAR SEUS ALUNOS</h5>
                                <p class="card-text">Verifique os alunos inscritos em suas matérias</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Card 4: Validar Hackathons --}}
            <div class="col">
                <a href="#" class="text-decoration-none">
                    <div class="card bg-secondary text-white h-100 shadow-lg">
                        <div class="card-body d-flex align-items-center py-5">
                            <div class="me-3">
                                <!-- Ícone aqui -->
                                <div class="bg-info rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 60px; height: 60px;">
                                    <!-- <i class="bi bi-check-circle"></i> -->
                                    <span class="text-white">✔️</span>
                                </div>
                            </div>
                            <div>
                                <h5 class="card-title text-warning">VALIDAR HACKATHONS</h5>
                                <p class="card-text">Valide os Hackathons que seus alunos estão fazendo!</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</main>

<!-- Bootstrap JS (opcional, caso queira usar interações no futuro) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection