@extends('layouts.app')

@section('title', 'Consultar Alunos por Matéria')

@section('content')

@php
$name = "GERENCIAR ALUNOS";
@endphp

<div class="container mt-2 mb-4">
    <div class="justify-content-between align-items-center mb-4">
        <div class="row justify-content-end">
            <a href="{{ route('professor.home') }}" class="col-2 btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Voltar ao Menu
            </a>
            <h2 class="col-8 h3 text-center">Encontre os alunos inscritos em cada Matéria</h2>
        <div class="col-2">
            <!--Espaço em branco-->
        </div>
        </div>
    </div>

    <!-- Mensagem quando nenhuma matéria foi selecionada -->
    @if(!request('materia_id'))
    <div class="container justify-content-center">
        <div class="row justify-content-md-center text-center mt-4">
            <div class="col-8 alert alert-secondary">
                <i class="fas fa-info-circle"></i>
                Selecione uma matéria abaixo para visualizar os alunos inscritos.
            </div>
        </div>
    </div>
    @endif

    <!-- Formulário de seleção de matéria -->
    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <div class="card border border-1 border-black shadow">
                <div class="card-header text-center" style="background: linear-gradient(45deg, #ff6b35, #f7931e)">
                    <h5 class="mb-0 text-light">Selecione uma Matéria</h5>
                </div>
                <div class="card-body bg-secondary text-center">
                    <!-- Formulário que será submetido quando uma matéria for selecionada -->
                    <form method="GET" action="{{ route('turmas.index') }}" id="materiaForm">
                        <div class="mb-3">
                            <label for="materia_id" class="form-label text-light">Matéria:</label>
                            <!-- Select menu do Bootstrap para escolher a matéria -->
                            <select class="form-select text-center" id="materia_id" name="materia_id" onchange="submitForm()">
                                <option value="">---- Selecione uma matéria ----</option>
                                <!-- Loop através de todas as matérias disponíveis no banco -->
                                @foreach ($materias as $materia)
                                <!--2°linha: Compara se o id da requisição (get) é igual ao ID da matéria atual do loop-->
                                    <option value="{{ $materia->materia_id }}" 
                                        {{ request('materia_id') == $materia->materia_id ? 'selected' : '' }}>
                                        
                                        {{ $materia->nome_materia }} - {{ $materia->bimestre_cubo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Mensagens de feedback para o usuário -->
    @if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
    @endif

    <!-- Rodapé com informações estatísticas -->
     @if(request('materia_id'))
    <div class="mt-3">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-secondary text-center">
                   Total de alunos inscritos:<strong> {{ count($alunos) }}</strong>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Seção que só aparece quando uma matéria é selecionada -->
    @if(request('materia_id') && $materiaSelecionada)
        <!--<div class="mb-3">
                <div class="alert alert-info text-center">
                    <strong>Matéria Selecionada:</strong> {{ $materiaSelecionada->nome_materia }} 
                    ({{ $materiaSelecionada->bimestre_cubo }}º Bimestre)
                </div>
            </div>  -->

    <!-- Tabela de alunos inscritos na matéria selecionada -->
    <div class="border rounded text-center">
        <div class="row">
            <table class="table table-striped mb-0">
                <thead class="h5 table-light">
                    <tr class="rounded">
                        <th class="">Nome do Aluno</th>
                        <th class="">Matrícula</th>
                        <th class="">Email</th>
                        <th class="">Curso</th>
                    </tr>
                </thead>
                <tbody class="table-light">
                    <!-- Verifica se existem alunos inscritos na matéria selecionada -->
                    @forelse ($alunos as $aluno)
                    <tr class="rounded">
                        <td class=""><strong>{{ $aluno->nome }}</strong></td>
                        <td class="">{{ $aluno->matricula }}</td>
                        <td class="">{{ $aluno->email }}</td>
                        <td class="">{{ $aluno->curso }}</td>
                    </tr>
                    @empty
                    <!-- Mensagem quando não há alunos inscritos na matéria -->
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Nenhum aluno está inscrito nesta matéria.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif

</div>

<!-- JavaScript para submeter o formulário automaticamente quando uma matéria for selecionada -->
<script>
    /**
     * Função que submete o formulário automaticamente quando o usuário seleciona uma matéria
     * Isso evita que o usuário tenha que clicar em um botão "Buscar" separado
     */
    function submitForm() {
        const select = document.getElementById('materia_id');
        // Só submete se uma matéria válida foi selecionada (não a opção padrão)
        if (select.value !== '') {
            document.getElementById('materiaForm').submit();
        }
    }
</script>

<!-- Bootstrap JS (necessário para funcionalidades do Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection