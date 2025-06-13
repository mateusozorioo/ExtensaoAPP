@extends('layouts.app')

@section('title', 'Gerenciar Matérias')

@section('content')

@php
$name = "GERENCIAR MATÉRIAS";
@endphp


<div class="container mt-2 mb-4">
    <div class="justify-content-between align-items-center mb-4">
        <div class="row justify-content-end">
            <h2 class="col-8 h3 text-center">Lista de Matérias</h2>
            <!-- Botão de adicionar nova matéria -->
            <a href="{{ route('materia.create') }}" class="col-2 btn btn-success">+ Nova Matéria</a>
        </div>
    </div>

    <!-- Mensagem de sucesso -->
    @if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    @endif

    <!-- Tabela de matérias -->
    <div class="border rounded text-center">
        <div class="row">
            <table class="table table-striped mb-0">
                <thead class="h5 table-light">
                    <tr class="rounded">
                        <th class="">Nome da Matéria</th>
                        <th class="">Bimestre (Cubo)</th>
                        <th>Ações</th> <!-- Nova coluna -->
                    </tr>
                </thead>
                <tbody class="table-light">
                    @forelse ($materias as $materia)
                    <tr class="rounded">
                        <td class="">{{ $materia->nome_materia }}</td>
                        <td class="">{{ $materia->bimestre_cubo }}</td>
                        <td>
                            <!-- Botão de edição -->
                            <!-- Para cada $materia -> materia_id é gerado os botões, que podem ser identificados pelo seu materia_id -->
                            <a href="{{ route('materia.edit', $materia->materia_id) }}" class="btn btn-sm btn-warning">
                                ✏️
                            </a>
                            <!-- Botão de exclusão -->
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $materia->materia_id }}">
                                ❌
                            </button>

                            <!-- Modal de confirmação de exclusão -->
                            <div class="modal fade" id="deleteModal{{ $materia->materia_id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel{{ $materia->materia_id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center w-100"
                                                id="deleteModalLabel{{ $materia->materia_id }}">
                                                Confirmar Exclusão</h5>
                                            <!-- data-bs-dismiss="modal": fecha o modal ao clicar -->
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Fechar"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            Tem certeza que deseja excluir a matéria
                                            <strong>{{ $materia->nome_materia }}</strong> permanentemente?
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <form action="{{ route('materia.destroy', $materia->materia_id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <!-- data-bs-dismiss="modal": fecha o modal ao clicar -->
                                                <button type="button" class="btn btn-dark"
                                                    data-bs-dismiss="modal">Não</button>
                                                <button type="submit" class="btn btn-danger">Sim</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">Nenhuma matéria cadastrada.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Bootstrap JS (opcional, caso queira usar interações no futuro) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection