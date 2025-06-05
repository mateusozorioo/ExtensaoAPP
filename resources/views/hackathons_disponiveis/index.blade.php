@extends('layouts.app')

@section('content')

@php
$name = "HACKATHONS UNIFIL";
@endphp


<div class="container mt-2 mb-4">
    <div class="justify-content-between align-items-center mb-4">
        <div class="row justify-content-end">
            <h2 class="col-8 h3 text-center">Lista de Hackathons Disponíveis</h2>
            <!-- Botão de adicionar nova matéria -->
            <a href="{{ route('hackathons-disponiveis.create') }}" class="col-2 btn btn-success">+ Adicionar
                Hackathon</a>
        </div>
    </div>

    <!-- Aqui ficará o espaço com os hackathons disponíveis quando implementarmos o READ -->

    @endsection