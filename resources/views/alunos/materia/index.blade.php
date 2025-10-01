@extends('layouts.appAluno')

@section('title', 'Grade Horária')

@php
$name = "INSCREVER-SE EM UMA MATÉRIA";
@endphp

@section('content')

<div class="container mt-2 mb-4">
    <div class="justify-content-between align-items-center mb-4">
        <div class="row justify-content-center">
            <div class="col-md-2 d-flex justify-content-start align-items-center">
                <div class="p-2">
                    <!-- MUDANÇA: De POST para GET (link simples) -->
                    <a href="{{ route('alunos.home') }}" class="btn btn-outline-secondary btn-lg border-2 px-4 shadow"">
                        <i class="bi bi-arrow-left me-2"></i><i class="fa-solid fa-house"></i>
                    </a>
                </div>
            </div>
            <h2 class="col-8 h4 text-center">Selecione a sua turma e sua matéria do Projeto Interdisciplinar (PI) do Bimestre!</h2>
            <div class="col-md-2"></div>
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

    <!-- Formulário de Inscrição -->
    <div class="row justify-content-center">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card shadow" style="background: linear-gradient(45deg, #ff6b35, #f7931e);">
                <div class="card-body text-white" >
                    <form method="POST" action="{{ route('alunos.materia.store') }}" id="formInscricao">
                        @csrf
                        
                        <!-- Seleção de Bimestre -->
                        <div class="mb-4">
                            <label class="form-label text-light h5">Bimestre (Cubo):</label>
                            <select class="form-select @error('bimestre_cubo') is-invalid @elseif(session('error')) is-invalid @enderror p-3" 
                                    name="bimestre_cubo" id="bimestre_cubo" required>
                                <option value="">Escolha seu bimestre:</option>
                                @foreach($bimestres as $bimestre)
                                    <option value="{{ $bimestre }}" {{ old('bimestre_cubo') == $bimestre ? 'selected' : '' }}>
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
                                <option value="">Escolha sua matéria</option>
                                @foreach($nomes_materias as $nome)
                                    <option value="{{ $nome }}" {{ old('nome_materia') == $nome ? 'selected' : '' }}>
                                        {{ $nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <!-- Botão de envio -->
                            <button type="submit" class="btn btn-success btn-lg px-4 shadow">
                                Confirmar Matéria
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
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

<!-- Script para validação em tempo real da combinação matéria+bimestre-->
<script>
// Aguarda o DOM estar completamente carregado antes de executar o código
document.addEventListener('DOMContentLoaded', function() {
    // Seleciona os elementos do formulário pelos IDs
    const form = document.getElementById('formInscricao'); // Formulário principal
    const bimestreSelect = document.getElementById('bimestre_cubo'); // Dropdown de bimestre
    const materiaSelect = document.getElementById('nome_materia'); // Dropdown de matéria
    
    // Recebe os dados das matérias do PHP e converte para objeto JavaScript
    // @json($materias) é uma diretiva Blade que converte array PHP para JSON
    const materiasData = @json($materias);
    
    // FUNÇÃO PRINCIPAL DE VALIDAÇÃO
    function validarCombinacao() {
        // Pega os valores atualmente selecionados nos dropdowns
        const bimestreSelecionado = bimestreSelect.value;
        const materiaSelecionada = materiaSelect.value;
        
        // Só valida se ambos os campos foram preenchidos
        if (bimestreSelecionado && materiaSelecionada) {
            // Verifica se existe a combinação no array de dados do banco
            // some() retorna true se pelo menos um elemento atender a condição
            const combinacaoExiste = materiasData.some(materia => 
                materia.nome_materia === materiaSelecionada && 
                materia.bimestre_cubo === bimestreSelecionado
            );
            
            // Se a combinação NÃO existe no banco de dados
            if (!combinacaoExiste) {
                // Adiciona classe CSS de erro (borda vermelha) nos dois campos
                bimestreSelect.classList.add('is-invalid');
                materiaSelect.classList.add('is-invalid');
            } else {
                // Se a combinação é válida, remove as classes de erro
                bimestreSelect.classList.remove('is-invalid');
                materiaSelect.classList.remove('is-invalid');
            }
        }
    }
    
    // EVENTOS DE VALIDAÇÃO EM TEMPO REAL
    // Executa validação sempre que o usuário mudar o bimestre
    bimestreSelect.addEventListener('change', validarCombinacao);
    
    // Executa validação sempre que o usuário mudar a matéria
    materiaSelect.addEventListener('change', validarCombinacao);
    
    // VALIDAÇÃO NO ENVIO DO FORMULÁRIO (última linha de defesa)
    form.addEventListener('submit', function(e) {
        // Pega novamente os valores selecionados no momento do submit
        const bimestreSelecionado = bimestreSelect.value;
        const materiaSelecionada = materiaSelect.value;
        
        // Se ambos campos estão preenchidos, faz a validação final
        if (bimestreSelecionado && materiaSelecionada) {
            // Verifica novamente se a combinação existe
            const combinacaoExiste = materiasData.some(materia => 
                materia.nome_materia === materiaSelecionada && 
                materia.bimestre_cubo === bimestreSelecionado
            );
            
            // Se a combinação é inválida
            if (!combinacaoExiste) {
                // IMPEDE o envio do formulário
                e.preventDefault();
                
                // Adiciona classes de erro visuais
                bimestreSelect.classList.add('is-invalid');
                materiaSelect.classList.add('is-invalid');
                
                // Mostra alerta para o usuário
                alert('A matéria e o bimestre devem condizer um com o outro.');
            }
            // Se chegou até aqui sem preventDefault(), o formulário será enviado normalmente
        }
    });
});
</script>

@endsection