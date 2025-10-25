@extends('layouts.appAluno')
@section('title', 'Acompanhar Solicitações')
@section('content')

@php
$name = 'Acompanhar Solicitações';
@endphp


<div class="container mt-2 mb-4">
    <div class="row d-flex justify-content-between align-items-center mb-4">
        <div class="col-md-2 col-0">
            <!-- Espaço em branco -->
        </div>
        <div class="col-md-8 col-6 text-center mb-4">
            <h2 class="h3">
                Acompanhe todas as solicitações feitas por você!
            </h2>
        </div>
        <div class="col-md-2 col-6 d-flex justify-content-end align-items-center">
            <div class="p-2">
                <a href="{{ route('alunos.home') }}" class="btn btn-outline-secondary btn-lg border-2 px-4 shadow">
                    <i class="fa-solid fa-house"></i><i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
    @foreach ($solicitacoes as $solicitacao)
        <div class="card border-1 border-black shadow mb-3" style="background-color: #808080ff">
            <div class="card-body">
                <div class="row text-center text-white justify-items-between my-2">  
                    <div class="col-md-4 col-6">
                        <b>Hackathon:</b><br>{{ $solicitacao->hackathonDisponivel->hackathon_nome }}
                    </div>
                    <div class="col-md-3 col-6">
                        <b>Método de Validação:</b><br>
                        @if($solicitacao->metodo_validacao == 'Formulário')
                            📝 Formulário
                        @elseif($solicitacao->metodo_validacao == 'Imagem')
                            🖼️ Imagem
                        @elseif($solicitacao->metodo_validacao == 'Certificado')
                            🏅 Certificado
                        @else
                            {{ $solicitacao->metodo_validacao }}
                        @endif
                    </div>
                    <div class="col-md-3 col-6">
                        <b>Data/hora:</b><br>{{ $solicitacao->data_solicitacao ?? '' }}
                    </div>
                    <div class="col-md-2 col-6">
                        <b>Status:</b><br>{{ $solicitacao->getStatusTexto()}}
                    </div>
                </div>
                @if($solicitacao->observacao)
                <div class="row text-white align-items-center">
                    <div class="form-label">
                        <b>Observação:</b>
                    </div>
                    <div class="form-control fw-bold p-3 border-0" style="background-color: #ff5c5cff">
                        {{ $solicitacao->observacao ?? '' }}    
                    </div>
                </div>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection