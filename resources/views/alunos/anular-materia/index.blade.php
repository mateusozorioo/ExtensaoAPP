@extends('layouts.appAluno')

@section('title', 'Anulação de Matéria')

@php
$name = "ANULAÇÃO DE MATÉRIA";
@endphp

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Font Awesome para ícones -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<div class="container mt-2 mb-4">
    <div class="justify-content-between align-items-center mb-4">
        <div class="row justify-content-center">
            <div class="col-md-2"></div>
            <h2 class="col-8 h4 text-center">Use seus Hackathons para anular a matéria de Projeto Interdisciplinar (PI) do bimestre</h2>
            <div class="col-md-2 d-flex justify-content-start align-items-center">
                <div class="p-2">
                    <a href="{{ route('alunos.home') }}" class="btn btn-outline-secondary btn-lg border-2 px-4 shadow">
                        <i class="fa-solid fa-house"></i><i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
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

    <!-- Card Principal -->
    <div class="row justify-content-center">
        <div class="col-md-2">
            
        </div>
        <div class="col-md-8">
            <div class="card shadow" style="background: linear-gradient(45deg, #ff6b35, #f7931e);">
                <div class="card-body text-white">
                    <div class="row align-items-center mb-4">
                        <div class="col-md-12 text-center my-4">
                            <label for="alert-materia" class="text-dark mb-1 fs-6"><strong>Matéria de PI escolhida no bimestre:</strong></label>
                            @if($aluno->materia_id && $aluno->materia)
                                <div class="alert alert-warning text-dark mb-0 p-4" id="alert-materia" role="alert">
                                    <p class="mb-0 fw-bold fs-3">{{ $aluno->materia->nome_materia }}</p>
                                </div>                               
                            @else
                                <div class="alert alert-secondary text-dark mb-0 p-4" role="alert">
                                    <h6 class="alert-heading fs-4 mb-0"><strong>Nenhuma matéria cadastrada</strong></h6>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="text-center">
                        @if($aluno->materia_id && $aluno->materia)
                            {{-- Só mostra o botão de anular se a matéria NÃO foi anulada ainda --}}
                            @if($aluno->materia_anulada != 1)
                                <button type="button" class="btn btn-success btn-lg px-4 shadow rounded-pill" data-bs-toggle="modal" data-bs-target="#confirmModal">
                                    <i class="fa-solid fa-ban me-2"></i>Anular
                                </button>
                            @else
                                {{-- Se já foi anulada, mostra uma mensagem informativa --}}
                                <div class="alert alert-primary text-dark mt-2 p-3" role="alert">
                                    <i class="fa-solid fa-check-circle me-2"></i>
                                    <strong>Matéria anulada nesse bimestre</strong>
                                </div>
                            @endif
                        @else
                            <a href="{{ route('alunos.materia.index') }}" class="btn btn-primary px-4 shadow rounded-pill text-decoration-none">
                                <i class="fa-solid fa-user-plus me-2"></i>Inscrever-se em uma matéria
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 text-center d-flex align-items-center justify-content-center">
            
            @if($aluno->materia_id && $aluno->materia)
                @if($aluno->materia_anulada != 1)
                    <div class="card shadow p-3 justify-content-center h-50">
                        <div class="text-black mb-2 h6">→ Alterar a matéria</div>
                        <a href="{{ route('alunos.materia.index') }}" class="btn btn-primary btn-sm rounded-pill shadow">
                            Clique aqui
                        </a>
                    </div>   
                @endif
            @endif
        </div>
    </div>

    <!-- Área para mensagem de crédito insuficiente -->
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div id="creditError" class="alert alert-danger text-center" style="display: none;">
                <div id="creditErrorMessage"></div>
                <a href="{{ route('alunos.solicitacao.index') }}" class="btn btn-danger btn-lg mt-3 rounded-pill shadow">
                    <i class="fa-solid fa-laptop-code me-2"></i>Ir para Validação de Hackathons
                </a>
            </div>
        </div>
    </div>

    <!-- Área para mensagem de matéria já anulada -->
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div id="alreadyCancelledError" class="alert alert-warning text-center" style="display: none;">
                <div id="alreadyCancelledMessage"></div>
                <a href="{{ route('alunos.home') }}" class="btn btn-warning btn-lg mt-3 rounded-pill shadow">
                    <i class="fa-solid fa-house"></i></i>Voltar ao Início
                </a>
            </div>
        </div>
    </div>
</div>

    <!-- Modal de Confirmação -->
    {{-- Só mostra o modal se o aluno tem matéria E ela ainda não foi anulada --}}
    @if($aluno->materia_id && $aluno->materia && $aluno->materia_anulada != 1)
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmar Anulação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja anular a materia <strong>{{ $aluno->materia->nome_materia }}</strong> durante um bimestre em troca de <strong>-1 crédito</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" id="confirmAnular">Sim</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de Sucesso -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Sucesso!</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="successMessage">
                    <!-- Mensagem será inserida via JavaScript -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="window.location.reload()">OK</button>
                </div>
            </div>
        </div>
    </div>

<!-- Script JavaScript usando apenas Bootstrap -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Pega o token CSRF do Laravel para as requisições AJAX
    const token = document.querySelector('meta[name="csrf-token"]');
    if (token) {
        window.csrfToken = token.getAttribute('content');
    }

    // Encontra o botão "Sim" do modal de confirmação
    const confirmBtn = document.getElementById('confirmAnular');
    if (confirmBtn) {
        confirmBtn.addEventListener('click', function() {
            
            // Pega a instância do modal do Bootstrap
            const confirmModalEl = document.getElementById('confirmModal');
            const confirmModal = bootstrap.Modal.getInstance(confirmModalEl);
            
            // Aqui está a parte importante que resolve o problema!
            // Vamos aguardar o modal fechar completamente antes de fazer qualquer coisa
            confirmModalEl.addEventListener('hidden.bs.modal', function handleModalClosed() {
                
                // Remove este listener para não executar várias vezes
                confirmModalEl.removeEventListener('hidden.bs.modal', handleModalClosed);
                
                // LIMPEZA FORÇADA: Remove qualquer "fantasma" do modal que possa ter sobrado
                // Isso resolve o problema da tela travada!
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(backdrop => backdrop.remove());
                
                // Restaura o body ao normal (remove classes/estilos do Bootstrap)
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';         // Volta o scroll
                document.body.style.paddingRight = '';     // Remove padding extra
                
                // Agora sim, faz a requisição para o servidor
                fetch('{{ route("alunos.anulacao.anular") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': window.csrfToken
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    
                    // Se deu tudo certo (aluno tinha créditos e não havia anulado antes)
                    if (data.success) {
                        // Mostra o modal verde de sucesso
                        document.getElementById('successMessage').innerHTML = data.message;
                        const successModalEl = document.getElementById('successModal');
                        const successModal = new bootstrap.Modal(successModalEl);
                        successModal.show();
                    } 
                    
                    // Se o aluno já havia anulado uma matéria este bimestre
                    else if (data.already_cancelled) {
                        // Mostra a div amarela com a mensagem e botão para voltar ao início
                        document.getElementById('alreadyCancelledMessage').innerHTML = data.message;
                        const alreadyCancelledEl = document.getElementById('alreadyCancelledError');
                        alreadyCancelledEl.style.display = 'block';
                        
                        // Faz um scroll suave para a mensagem aparecer na tela
                        setTimeout(() => {
                            alreadyCancelledEl.scrollIntoView({ 
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }, 100);
                    }
                    
                    // Se o aluno não tem créditos
                    else if (data.insufficient_credits) {
                        // Mostra a div vermelha com a mensagem e botão para hackathons
                        document.getElementById('creditErrorMessage').innerHTML = data.message;
                        const creditErrorEl = document.getElementById('creditError');
                        creditErrorEl.style.display = 'block';
                        
                        // Faz um scroll suave para a mensagem aparecer na tela
                        setTimeout(() => {
                            creditErrorEl.scrollIntoView({ 
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }, 100);
                    } 
                    
                    // Outros tipos de erro
                    else {
                        alert('Erro: ' + data.message);
                    }
                })
                .catch(error => {
                    // Se deu erro na requisição (internet, servidor, etc.)
                    console.error('Erro:', error);
                    alert('Erro interno do sistema. Tente novamente.');
                });
                
            }, { once: true }); // Importante: executa só uma vez
            
            // Inicia o fechamento do modal
            confirmModal.hide();
        });
    }
});

/* 
 * RESUMO: O que esse script faz?
 * 
 * 1. Usuário clica "Anular" → abre modal
 * 2. Usuário clica "Sim" → modal começa a fechar
 * 3. Script AGUARDA o modal fechar completamente (essa era a chave!)
 * 4. Remove qualquer "fantasma" do modal que possa ter sobrado
 * 5. Faz requisição para o servidor
 * 6. Mostra resultado: sucesso OU erro de créditos OU já anulou OU erro geral
 * 
 * AGORA COM 3 TIPOS DE RESPOSTA:
 * - Sucesso: modal verde
 * - Sem créditos: div vermelha + botão hackathons
 * - Já anulou: div amarela + botão voltar ao início
 * 
 * O problema era que antes fazíamos a requisição muito rápido,
 * antes do modal terminar de fechar, aí ficava o backdrop invisível
 * travando a tela. Agora esperamos ele fechar 100% primeiro!
 */
</script>

@endsection