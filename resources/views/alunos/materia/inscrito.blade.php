@extends('layouts.appAluno')

@section('title', 'Grade Horária')

@php
$name = "CONSULTAR SUA MATÉRIA";
@endphp

@section('content')

<div class="container mt-2 mb-4">

    <!-- Mensagem de sucesso -->
    @if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    @endif

 
    <!-- Card de Consulta -->
    <div class="row justify-content-center">
        <div class="col-md-2 d-flex justify-content-center align-items-center">
            <div class=" text-center h-50">
                <div class="p-2">
                    <p class="text-dark mb-3 h5"><strong>Voltar para o menu:</strong></p>
                    <!-- MUDANÇA: De POST para GET (link simples) -->
                    <a href="{{ route('alunos.home') }}" class="btn btn-outline-secondary btn-lg px-4 shadow"">
                        <i class="bi bi-arrow-left me-2"></i><i class="fa-solid fa-house"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-8 text-center">
            <div class="card shadow my-3">
                <div class="card-header text-white pb-0 bg-secondary">
                    <div class="row justify-content-center align-items-center">
                        <h2 class="col-8 h5 text-center text-white">INSCRITO!</h2>
                    </div>
                </div>
                <div class="card-body bg-warning">
                    <!-- Bimestre -->
                    <div class="mb-4">
                        <label class="form-label text-dark h5 pb-2">Bimestre (Cubo):</label>
                        <div class="form-control fw-bold text-center p-3" 
                             style="font-size: 1.5rem; color: #ff6b35; background-color: #e8e8e8">
                            {{ $materia->bimestre_cubo }}
                        </div>
                    </div>
                    <!-- Matéria -->
                    <div class="mb-4">
                        <label class="form-label text-dark h5 pb-2">Matéria de PI:</label>
                        <div class="form-control fw-bold text-center p-3" 
                             style="font-size: 1.5rem; color: #ff6207ff; background-color: #e8e8e8">
                            {{ $materia->nome_materia }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Verificação se matéria foi anulada -->
        <div class="col-md-2 d-flex justify-content-center align-items-center">
            @if($aluno->materia_anulada == 1)
                <!-- Exibe mensagem se a matéria foi anulada -->
                <div class="card text-center border-primary shadow">
                    <div class="card-body p-3 bg-info">
                        <div class="mb-2">
                            <i class="fa-solid bi bi-info-circle-fill text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="text-primary mb-2"><strong>Matéria Já Anulada</strong></h6>
                        <p class="text-dark small mb-0" style="line-height: 1.3;">
                            <strong>Matéria anulada durante o bimestre todo! Aguarde o próximo bimestre para se inscrever em uma nova matéria.</strong>
                        </p>
                    </div>
                </div>
            @else
                <!-- Exibe botão alterar se a matéria NÃO foi anulada -->
                <div class="card text-center">
                    <div class="card-body p-2">
                        <p class="text-dark mb-3"><strong>Quer alterar alguma informação?</strong></p>
                        <!-- MUDANÇA: De POST para GET (link simples) -->
                        <a href="{{ route('alunos.materia.edit') }}" class="btn btn-primary btn-lg px-4 shadow">
                            Alterar
                        </a>
                        <div class="mt-2">
                            <small class="text-dark">Clique aqui para ajustar sua escolha!</small>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

</div>

<!-- Font Awesome para ícones -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection