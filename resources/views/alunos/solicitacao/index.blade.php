@extends('layouts.app')

@section('title', 'Validação de Hackathons')

@section('content')

@php
$name = "VALIDAÇÃO DE HACKATHONS";
@endphp

<div class="container mt-2 mb-4">
    <div class="justify-content-between align-items-center mb-4">
        <div class="row justify-content-center">
            <h2 class="col-12 h3 text-center mb-3">Valide os Hackathons feitos por você!</h2>
        </div>
    </div>

    <!-- Mensagens de feedback -->
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

    <!-- Exibição de erros de validação -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Formulário de Solicitação -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">📋 Nova Solicitação de Validação</h4>
                </div>
                <div class="card-body bg-light">
                    <!-- 
                        Formulário para envio da solicitação
                        - enctype="multipart/form-data": necessário para upload de arquivos
                        - method="POST": método HTTP para envio
                        - action: rota que processará o formulário
                    -->
                    <form action="{{ route('alunos.solicitacao.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- Token de segurança do Laravel -->

                        <!-- Campo: Escolha do Hackathon -->
                        <div class="mb-4">
                            <label for="hackathons_disponiveis_id" class="form-label fw-bold">
                                🏆 Escolha qual Hackathon você está participando
                            </label>
                            <select class="form-select @error('hackathons_disponiveis_id') is-invalid @enderror" 
                                    id="hackathons_disponiveis_id" 
                                    name="hackathons_disponiveis_id" 
                                    required>
                                <option value="" disabled selected>Escolha seu Hackathon:</option>
                                @foreach($hackathons as $hackathon)
                                    <option class="text-dark" value="{{ $hackathon->hackathons_disponiveis_id }}" 
                                            {{ old('hackathons_disponiveis_id') == $hackathon->hackathons_disponiveis_id ? 'selected' : '' }}>
                                        {{ $hackathon->hackathon_nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('hackathons_disponiveis_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo: Método de Validação -->
                        <div class="mb-4">
                            <label for="metodo_validacao" class="form-label fw-bold">
                                🔍 Método de Validação
                            </label>
                            <select class="form-select @error('metodo_validacao') is-invalid @enderror" 
                                    id="metodo_validacao" 
                                    name="metodo_validacao" 
                                    required>
                                <option value="" disabled selected>Escolha o método</option>
                                <!-- 
                                    Opções fixas conforme especificação:
                                    - Formulário, Imagem ou Certificado
                                    - Auxilia o professor na validação
                                -->
                                <option value="Formulário" {{ old('metodo_validacao') == 'Formulário' ? 'selected' : '' }}>
                                    📝 Formulário
                                </option>
                                <option value="Imagem" {{ old('metodo_validacao') == 'Imagem' ? 'selected' : '' }}>
                                    🖼️ Imagem
                                </option>
                                <option value="Certificado" {{ old('metodo_validacao') == 'Certificado' ? 'selected' : '' }}>
                                    🏅 Certificado
                                </option>
                            </select>
                            @error('metodo_validacao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                💡 Selecione o tipo de comprovação que você irá enviar para auxiliar o professor
                            </div>
                        </div>

                        <!-- Campo: Upload do Arquivo -->
                        <div class="mb-4">
                            <label for="arquivo_prova" class="form-label fw-bold">
                                📎 Arquivo de verificação
                            </label>
                            <input type="file" 
                                   class="form-control @error('arquivo_prova') is-invalid @enderror" 
                                   id="arquivo_prova" 
                                   name="arquivo_prova"
                                   accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                   required>
                            @error('arquivo_prova')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                📋 Coloque aqui o arquivo de verificação (PDF, imagem ou documento)
                            </div>
                        </div>

                        <!-- Campo oculto: ID do aluno logado -->
                        <!-- 
                            Assumindo que você tem autenticação e pode pegar o ID do aluno logado
                            Se não tiver auth, você pode remover este campo e tratar no controller
                        -->
                        <input type="hidden" name="aluno_id" value="{{ auth()->user()->id ?? 1 }}">

                        <!-- Botões de Ação -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <!-- Botão de voltar -->
                            <a href="#" class="btn btn-secondary me-md-2">
                                ↩️ Voltar
                            </a>
                            
                            <!-- Botão de envio -->
                            <button type="submit" class="btn btn-success btn-lg">
                                ✅ Enviar para verificação
                            </button>
                        </div>

                        <!-- Informação adicional -->
                        <div class="mt-3 text-center">
                            <small class="text-muted">
                                ℹ️ O documento será verificado pelo seu professor
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (para interações) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection