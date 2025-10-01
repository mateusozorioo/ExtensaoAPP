@extends('layouts.appAluno')

@section('title', 'Grade Horária')

@php
$name = "ALTERAR SUA MATÉRIA";
@endphp

@section('content')

<div class="container mt-2 mb-4">
    <div class="justify-content-between align-items-center mb-4">
        <div class="row justify-content-center">
            <h2 class="col-8 h4 text-center">Altere a sua turma e sua matéria do Projeto Interdisciplinar (PI) do Bimestre!</h2>
        </div>
    </div>

    <!-- Mensagens de sucesso e erro -->
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

    <!-- Formulário de Alteração -->
    <div class="row justify-content-center">
        <div class="col-md-2 d-flex justify-content-center align-items-center">
            <div class=" text-center h-50">
                <div class="p-2">
                    <p class="text-dark mb-3 h5"><strong>Voltar para o menu:</strong></p>
                    <!-- MUDANÇA: De POST para GET (link simples) -->
                    <a href="{{ route('alunos.home') }}" class="btn btn-outline-secondary btn-lg border-2 px-4 shadow"">
                        <i class="bi bi-arrow-left me-2"></i><i class="fa-solid fa-house"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow" style="background: linear-gradient(45deg, #ff6b35, #f7931e);">
                <div class="card-body text-white">
                    <form method="POST" action="{{ route('alunos.materia.update') }}" id="formAlteracao">
                        @csrf
                        
                        <!-- Seleção de Bimestre -->
                        <div class="mb-4">
                            <label class="form-label text-light h5">Bimestre (Cubo):</label>
                            <select class="form-select @error('bimestre_cubo') is-invalid @elseif(session('error')) is-invalid @enderror p-3" 
                                    name="bimestre_cubo" id="bimestre_cubo" required>
                                @foreach($bimestres as $bimestre)
                                    <option value="{{ $bimestre }}" 
                                        {{ (old('bimestre_cubo', $materiaAtual->bimestre_cubo) == $bimestre) ? 'selected' : '' }}>
                                        {{ $bimestre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Seleção de Matéria -->
                        <div class="mb-4">
                            <label class="form-label text-light h5">Matéria de PI:</label>
                            <select class="form-select @error('nome_materia') is-invalid @elseif(session('error')) is-invalid @enderror p-3" 
                                    name="nome_materia" id="nome_materia" required>
                                @foreach($nomes_materias as $nome)
                                    <option value="{{ $nome }}" 
                                        {{ (old('nome_materia', $materiaAtual->nome_materia) == $nome) ? 'selected' : '' }}>
                                        {{ $nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <!-- Botão de voltar -->
                            <a href="{{ route('alunos.materia.index') }}" class="btn btn-secondary btn-lg me-md-2 shadow">
                                <i class="bi bi-arrow-left me-2"></i>Voltar
                            </a>
                            
                            <!-- Botão de envio -->
                            <button type="submit" class="btn btn-success btn-lg px-4 shadow">
                                Inscrever-se 
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-2 d-flex justify-content-center align-items-center">
            <div class="card text-center">
                <div class="card-body p-2">
                    <p class="text-dark mb-3"><strong>Quer Limpar suas informações?</strong></p>
                    <!-- MUDANÇA: De POST para GET (link simples) -->
                    <button type="button" class="btn btn-danger btn-lg px-3 py-1 mb-2 shadow" data-bs-toggle="modal" data-bs-target="#sairMateriaModal">Sair da matéria</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal de confirmação para sair da matéria -->
    <div class="modal fade" id="sairMateriaModal" tabindex="-1" aria-labelledby="sairMateriaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center w-100" id="sairMateriaModalLabel">
                        Confirmar Saída da Matéria
                    </h5>
                    <!-- data-bs-dismiss="modal": fecha o modal ao clicar -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body text-center">
                    Tem certeza que deseja sair da matéria 
                    <strong>{{ $materiaAtual->nome_materia ?? 'atual' }}</strong>?
                    <br><small class="text-muted">Esta ação removerá sua inscrição na matéria.</small>
                </div>
                <div class="modal-footer justify-content-center">
                    <form action="{{ route('alunos.materia.destroy') }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <!-- data-bs-dismiss="modal": fecha o modal ao clicar -->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                        <button type="submit" class="btn btn-danger">Sim, sair da matéria</button>
                    </form>
                </div>
            </div>
        </div>
    </div>    

</div>

<style>
.form-select.is-invalid {
    border-color: #dc3545;
    background-color: #f8d7da;
}
</style>

<!-- Font Awesome para ícones -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Script para validação em tempo real -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formAlteracao');
    const bimestreSelect = document.getElementById('bimestre_cubo');
    const materiaSelect = document.getElementById('nome_materia');
    
    // Dados das matérias para validação JavaScript
    const materiasData = @json($materias);
    
    function validarCombinacao() {
        const bimestreSelecionado = bimestreSelect.value;
        const materiaSelecionada = materiaSelect.value;
        
        if (bimestreSelecionado && materiaSelecionada) {
            // Verifica se existe a combinação no banco
            const combinacaoExiste = materiasData.some(materia => 
                materia.nome_materia === materiaSelecionada && 
                materia.bimestre_cubo === bimestreSelecionado
            );
            
            if (!combinacaoExiste) {
                // Adiciona classe de erro
                bimestreSelect.classList.add('is-invalid');
                materiaSelect.classList.add('is-invalid');
            } else {
                // Remove classe de erro
                bimestreSelect.classList.remove('is-invalid');
                materiaSelect.classList.remove('is-invalid');
            }
        }
    }
    
    // Adiciona listeners para validação em tempo real
    bimestreSelect.addEventListener('change', validarCombinacao);
    materiaSelect.addEventListener('change', validarCombinacao);
    
    // Validação no submit
    form.addEventListener('submit', function(e) {
        const bimestreSelecionado = bimestreSelect.value;
        const materiaSelecionada = materiaSelect.value;
        
        if (bimestreSelecionado && materiaSelecionada) {
            const combinacaoExiste = materiasData.some(materia => 
                materia.nome_materia === materiaSelecionada && 
                materia.bimestre_cubo === bimestreSelecionado
            );
            
            if (!combinacaoExiste) {
                e.preventDefault();
                bimestreSelect.classList.add('is-invalid');
                materiaSelect.classList.add('is-invalid');
                
                // Mostra alerta
                alert('A matéria e o bimestre devem condizer um com o outro.');
            }
        }
    });
});
</script>

@endsection