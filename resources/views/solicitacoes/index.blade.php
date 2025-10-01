@extends('layouts.app')

@section('title', 'Gerenciar Solicitações de Hackathons')

@php
$name = "VALIDAR PARTICIPAÇÃO";
@endphp

@section('content')

<div class="container mt-2 mb-4">
    <div class="justify-content-center align-items-center mb-4">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-2 d-flex justify-content-start align-items-center">
                <div class="p-2">
                    <!-- MUDANÇA: De POST para GET (link simples) -->
                    <a href="{{ route('professor.home') }}" class="btn btn-outline-secondary btn-lg border-2 px-4 shadow"">
                        <i class="bi bi-arrow-left me-2"></i><i class="fa-solid fa-house"></i>
                    </a>
                </div>
            </div>
            <h2 class="col-md-8 h3 text-center">Gerenciar Solicitações de Hackathons</h2>
            <div class="col-md-2"></div>
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

    <!-- Lista de Solicitações -->
    @if($solicitacoes->count() > 0)
        @foreach($solicitacoes as $solicitacao)
        <div class="row justify-content-center mb-3">
            <div class="col-12">
                <div class="card shadow bg-white">
                    <div class="card-body p-3 text-secondary">
                        <div class="row align-items-center">
                            <!-- Informações do aluno e solicitação -->
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="rounded-circle text-dark d-flex align-items-center justify-content-center me-2 bg-warning" 
                                                 style="width: 40px; height: 40px">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div class="ms-3" style="color: #f7931e;">
                                                <strong>{{ $solicitacao->aluno->nome ?? 'Nome não encontrado' }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <strong style="color: #f7931e;">
                                            Hackathon:
                                        </strong>
                                        <br>
                                        <span class="fw-bold">{{ $solicitacao->hackathonDisponivel->hackathon_nome ?? 'Hackathon não encontrado' }}</span>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <strong style="color: #f7931e;">Método:</strong>
                                        <br>
                                        <span class="fw-bold">
                                            @if($solicitacao->metodo_validacao == 'Formulário')
                                                📝 Formulário
                                            @elseif($solicitacao->metodo_validacao == 'Imagem')
                                                🖼️ Imagem
                                            @elseif($solicitacao->metodo_validacao == 'Certificado')
                                                🏅 Certificado
                                            @else
                                                {{ $solicitacao->metodo_validacao }}
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <strong style="color: #f7931e;">Data:</strong>
                                        <br>
                                        <!--getDataFormada está na Model Solicitacao-->
                                        <span class="fw-bold">{{ $solicitacao->getDataFormatada() }}</span>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <!-- Botões de ação -->
                            <div class="col-md-4 text-end">
                                @if($solicitacao->arquivo_prova)
                                <!-- Botão para ver arquivo com preview no hover -->
                                <a target="_blank" 
                                   class="btn btn-warning ms-2 me-2 text-dark shadow image-preview-btn" 
                                   href="{{ Storage::url($solicitacao->arquivo_prova) }}"
                                   data-bs-toggle="popover"
                                   data-bs-trigger="hover"
                                   data-bs-placement="top"
                                   data-bs-html="true"
                                   data-image-url="{{ Storage::url($solicitacao->arquivo_prova) }}"
                                   title="Preview da Comprovação">
                                    📎 Ver Arquivo de Comprovação
                                </a>
                                @endif
                                
                                <!-- Botão Aceitar -->
                                <button type="button" 
                                        class="btn btn-success me-2 d-inline" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalAceitar{{ $solicitacao->solicitacao_id }}">
                                    <i class="fas fa-check"></i> 
                                </button>
                                <!-- Botão Recusar -->
                                <button type="button" 
                                        class="btn btn-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalRecusar{{ $solicitacao->solicitacao_id }}">
                                    <i class="fas fa-times"></i> 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para Aceitar Solicitação -->
        <div class="modal fade" id="modalAceitar{{ $solicitacao->solicitacao_id }}" tabindex="-1" aria-labelledby="modalAceitarLabel{{ $solicitacao->solicitacao_id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="modalAceitarLabel{{ $solicitacao->solicitacao_id }}">
                            <i class="fas fa-exclamation-triangle me-2"></i>Recusar Solicitação
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <form action="{{ route('solicitacoes.aceitar', $solicitacao->solicitacao_id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="modal-body">
                            <p class="text-center">
                                Deseja aceitar a solicitação do(a) aluno(a) <strong>{{ $solicitacao->aluno->nome ?? 'Nome não encontrado' }}</strong>?
                            </p>
                        </div>
                        
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i> Cancelar
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check"></i> Aceitar Solicitação
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal para Recusar Solicitação -->
        <div class="modal fade" id="modalRecusar{{ $solicitacao->solicitacao_id }}" tabindex="-1" aria-labelledby="modalRecusarLabel{{ $solicitacao->solicitacao_id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="modalRecusarLabel{{ $solicitacao->solicitacao_id }}">
                            <i class="fas fa-exclamation-triangle me-2"></i>Recusar Solicitação
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <form action="{{ route('solicitacoes.recusar', $solicitacao->solicitacao_id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="modal-body">
                            <div class="mb-3">
                                <p class="mb-3">
                                    <strong>Aluno:</strong> {{ $solicitacao->aluno->nome ?? 'Nome não encontrado' }}<br>
                                    <strong>Hackathon:</strong> {{ $solicitacao->hackathonDisponivel->hackathon_nome ?? 'Hackathon não encontrado' }}
                                </p>
                                
                                <label for="observacao{{ $solicitacao->solicitacao_id }}" class="form-label">
                                    <strong>Motivo da recusa:</strong>
                                </label>
                                <textarea class="form-control" 
                                          id="observacao{{ $solicitacao->solicitacao_id }}" 
                                          name="observacao" 
                                          rows="4" 
                                          placeholder="Explique o motivo da recusa da solicitação..." 
                                          required></textarea>
                                <div class="form-text">
                                    Esta observação será enviada para o aluno.
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i> Cancelar
                            </button>
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-ban me-1"></i> Recusar Solicitação
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Paginação (se necessário) -->
        <div class="d-flex justify-content-center mt-4">
            {{ $solicitacoes->links() }}
        </div>

    @else
        <!-- Caso não existam solicitações pendentes -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-clipboard-check fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Nenhuma solicitação pendente</h4>
                        <p class="text-muted">
                            Não há solicitações de validação de hackathons aguardando aprovação no momento.
                        </p>
                        <a href="{{ route('professor.home') }}" class="btn btn-primary">
                            <i class="fas fa-home me-2"></i>Voltar ao início
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- CSS customizado para o preview -->
<style>
.popover {
    max-width: 400px !important;
    border: 2px solid #f7931e;
}

.popover-header {
    background-color: #f7931e !important;
    color: white !important;
    border-bottom: 1px solid #f7931e !important;
}

.image-preview {
    max-width: 350px;
    max-height: 250px;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

</style>

<!-- Script personalizado para preview de imagem -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Função para verificar se o arquivo é uma imagem
    function isImageFile(url) {
        return /\.(jpg|jpeg|png|gif|bmp|webp|svg)$/i.test(url);
    }

    // Função para verificar se o arquivo é um PDF
    function isPdfFile(url) {
        return /\.pdf$/i.test(url);
    }

    // Inicializar popovers para preview de imagem
    var imagePreviewButtons = document.querySelectorAll('.image-preview-btn');
    
    imagePreviewButtons.forEach(function(button) {
        var imageUrl = button.getAttribute('data-image-url');
        var popoverContent = '';
        
        if (isImageFile(imageUrl)) {
            // Para imagens, mostra preview
            popoverContent = `
                <div class="text-center">

                    <img src="${imageUrl}" 
                         class="image-preview" 
                         alt="Preview da comprovação"
                    <br><small class="text-muted mt-2">Clique no botão para ver em tela cheia</small>
                </div>
            `;
        } else if (isPdfFile(imageUrl)) {
            // Para PDFs, mostra ícone e informação
            popoverContent = `
                <div class="text-center">
                    <div style="font-size: 3rem; color: #f7931e; margin-bottom: 10px;">📄</div>
                    <p class="mb-2"><strong>Arquivo PDF</strong></p>
                    <small class="text-muted">Clique para abrir o documento</small>
                </div>
            `;
        } else {
            // Para outros tipos de arquivo
            popoverContent = `
                <div class="text-center">
                    <div style="font-size: 3rem; color: #f7931e; margin-bottom: 10px;">📎</div>
                    <p class="mb-2"><strong>Arquivo Anexado</strong></p>
                    <small class="text-muted">Clique para visualizar</small>
                </div>
            `;
        }

        // Configurar popover
        button.setAttribute('data-bs-content', popoverContent);

        // Inicializar popover do Bootstrap
        new bootstrap.Popover(button, {
            html: true,
            trigger: 'hover',
            placement: 'top',
            container: 'body'
        });
    });
    
    // Limpar popovers quando necessário (opcional)
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.image-preview-btn')) {
            var popovers = document.querySelectorAll('.popover');
            popovers.forEach(function(popover) {
                var popoverInstance = bootstrap.Popover.getInstance(popover);
                if (popoverInstance) {
                    popoverInstance.hide();
                }
            });
        }
    });
});
</script>

@endsection