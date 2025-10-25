@extends('layouts.appAluno')

@section('title', 'Validação de Hackathons')

@section('content')

@php
$name = "FORMULÁRIO DE VALIDAÇÃO DE HACKATHONS";
@endphp

<div class="container mt-2 mb-4">
        <div class="row justify-content-center align-items-center mb-3">
            <div class="col-md-2 d-flex justify-content-start align-items-center">
                <div class="p-2">
                    <!-- MUDANÇA: De POST para GET (link simples) -->
                    <a href="{{ route('alunos.home') }}" class="btn btn-outline-secondary btn-lg border-2 px-4 shadow"">
                        <i class="bi bi-arrow-left me-2"></i><i class="fa-solid fa-house"></i>
                    </a>
                </div>
            </div>
            <h2 class="col-md-8 h3 text-center">Valide os Hackathons feitos por você!</h2>
            <div class="col-md-2"></div>
        </div>

    <!-- Mensagens de feedback (mantidas para fallback) -->
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
        <div class="col-md-9">
            <div class="card shadow">
                <div class="card-body bg-warning">
                    <form id="solicitacaoForm" action="{{ route('alunos.solicitacao.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- Token de segurança do Laravel -->

                        <!-- Campo: Escolha do Hackathon -->
                        <div class="mb-4">
                            <label for="hackathons_disponiveis_id" class="form-label fw-bold">
                                Escolha qual Hackathon você está participando (nos últimos 3 meses):
                            </label>
                            <select class="form-select @error('hackathons_disponiveis_id') is-invalid @enderror p-3" 
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
                                Método de Validação:
                            </label>
                            <select class="form-select @error('metodo_validacao') is-invalid @enderror p-3" 
                                    id="metodo_validacao" 
                                    name="metodo_validacao" 
                                    required>
                                <option value="" disabled selected>Escolha o método</option>
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
                                * Selecione o tipo de comprovação que você irá enviar para auxiliar o professor
                            </div>
                        </div>

                        <!-- Campo: Upload do Arquivo -->
                        <div class="mb-4">
                            <label for="arquivo_prova" class="form-label fw-bold">
                                📎 Arquivo de verificação
                            </label>
                            <input type="file" 
                                   class="form-control @error('arquivo_prova') is-invalid @enderror p-3" 
                                   id="arquivo_prova" 
                                   name="arquivo_prova"
                                   accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                   required>
                            @error('arquivo_prova')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                * Coloque aqui o arquivo de verificação (PDF, imagem ou documento)
                            </div>
                        </div>

                        <!-- Campo oculto: ID do aluno logado -->
                        <input type="hidden" name="aluno_id" value="{{ auth()->user()->id ?? 1 }}">

                        <!-- Botões de Ação -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <!-- Botão de envio com loading simples -->
                            <button type="submit" id="btnEnviar" class="btn btn-success btn-lg px-4 shadow rounded-pill">
                                <span class="btn-text">
                                    <i class="fa-solid fa-paper-plane me-2"></i> Enviar Solicitação
                                </span>
                                <span class="btn-loading d-none">
                                    <i class="fa-solid fa-spinner fa-spin me-2"></i> Enviando...
                                </span>
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

<!-- Modal de Sucesso -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">
                    <i class="fa-solid fa-check-circle me-2"></i>Sucesso!
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fa-solid fa-check-circle text-success" style="font-size: 3rem;"></i>
                <h4 class="mt-3 text-success">Solicitação Enviada!</h4>
                <p class="mb-0">{{ session('success') }}</p>
                <small class="text-muted d-block mt-2">
                    <i class="fa-solid fa-clock me-1"></i>
                    Agora é só aguardar a análise do seu professor!
                </small>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-success px-4" onclick="voltarParaHome()">
                    <i class="fa-solid fa-check me-2"></i>Entendi (Voltar para o Menu)
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Erro -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="errorModalLabel">
                    <i class="fa-solid fa-exclamation-triangle me-2"></i>Ops!
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fa-solid fa-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
                <h4 class="mt-3 text-danger">Algo deu errado!</h4>
                <p class="mb-0">{{ session('error') }}</p>
                <small class="text-muted d-block mt-2">
                    <i class="fa-solid fa-info-circle me-1"></i>
                    Tente novamente ou entre em contato com o suporte.
                </small>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">
                    <i class="fa-solid fa-times me-2"></i>Fechar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Mostrar modal de sucesso se houver mensagem de sucesso na sessão
@if(session('success'))
    document.addEventListener("DOMContentLoaded", function() {
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    });
@endif

// Mostrar modal de erro se houver mensagem de erro na sessão
@if(session('error'))
    document.addEventListener("DOMContentLoaded", function() {
        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        errorModal.show();
    });
@endif

// Loading simples no botão (opcional)
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('solicitacaoForm');
    const btnEnviar = document.getElementById('btnEnviar');
    
    if (form && btnEnviar) {
        form.addEventListener('submit', function() {
            const btnText = btnEnviar.querySelector('.btn-text');
            const btnLoading = btnEnviar.querySelector('.btn-loading');
            
            // Desabilitar botão e mostrar loading
            btnEnviar.disabled = true;
            btnText.classList.add('d-none');
            btnLoading.classList.remove('d-none');
        });
    }
});

// Função para voltar para home
function voltarParaHome() {
    window.location.href = "{{ route('alunos.home') }}";
}
</script>

@endsection