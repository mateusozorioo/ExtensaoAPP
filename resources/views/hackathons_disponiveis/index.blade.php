@extends('layouts.app')
@section('title', 'Hackathons Unifil')
@section('content')

@php
$name = "HACKATHONS UNIFIL";
@endphp


<div class="container mt-2 mb-4">
    <div class="row justify-content-center mb-4">
        <div class="col-lg-4">
            <!-- Espaço vazio para simular o gap dos hackathons -->
        </div>
        <!-- Botão de edição de hackathons -->
        <div class="col-lg-2 mb-2">
            <a href="{{ route('hackathons-disponiveis.edicao') }}" class="btn btn-warning w-100">
                ✏️ Editar Hackathons
            </a>
        </div>
        <!-- Botão de adicionar hackathon -->
        <div class="col-lg-2 mb-2">
            <a href="{{ route('hackathons-disponiveis.create') }}" class="btn btn-success w-100">
                + Adicionar Hackathon
            </a>
        </div>
        <div class="col-lg-4">
            <!-- Espaço vazio para simular o gap dos hackathons -->
        </div>
    </div>
    <div class="row justify-content-center mb-2">
        <h2 class="col-8 h3 text-center">Lista de Hackathons Disponíveis</h2>
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

    <!-- Lista de hackathons disponíveis -->
    <div class="row">
        @foreach ($hackathons as $hackathon)
            <div class="col-md-6 mb-4">
                <a href="{{ $hackathon->hackathon_link }}" target="_blank" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow bg-secondary" style="border-radius: 15px; overflow: hidden;">
                        <img src="{{ asset($hackathon->hackathon_imagem) }}" 
                             class="card-img-top" 
                             alt="{{ $hackathon->hackathon_nome }}"
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title text-light mb-0">{{ strtoupper($hackathon->hackathon_nome) }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <!-- Mensagem quando não há hackathons -->
    @if($hackathons->isEmpty())
        <div class="row">
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    <h4>Nenhum Hackathon disponível no momento</h4>
                    <p>Adicione um novo Hackathon na opção "+ Adicionar Hackathon"</p>
                </div>
            </div>
        </div>
    @endif
</div>
    @endsection