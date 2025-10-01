<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <title>@yield('title', 'Extensão APP')</title>

        <!-- BOOTSTRAP CSS 5.3-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        <!-- Bootstrap Icons -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">

    </head>

    <body class="bg-secondary">
        
        <div class="container mt-4 mb-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <!-- Card principal de confirmação -->
                    <div class="card shadow-lg bg-light border border-black border-2 mt-3">
                        <div class="card-header text-white text-center py-4" style="background-color: #FF9500;">
                            <h2 class="h4 mb-0">
                                ✅ Solicitação Enviada com Sucesso!
                            </h2>
                        </div>
                        
                        <div class="card-body text-center py-2">
                            <!-- Ícone de sucesso -->
                            <div class="mb-3 mt-2">
                                <div class="text-white rounded-circle d-inline-flex align-items-center justify-content-center" 
                                style="width: 80px; height: 80px; font-size: 2.5rem; background-color: #2c2525ff;">
                                🎉
                            </div>
                        </div>
                        
                        <!-- Mensagem principal -->
                        <h3 class="mb-3" style="color: #FF9500;">Parabéns!</h3>
                        <p class="lead text-dark mb-4">
                            <strong>Sua solicitação de validação de hackathon foi enviada com sucesso.</strong>
                        </p>
                        
                        <!-- Informações do que acontece agora -->
                        <div class="card border border-info">
                            <div class="card-header bg-secondary">
                                <h5 class="text-white">
                                    📋 Próximos passos:
                                </h5>
                            </div>
                            <div class="card-body bg-info">
                                <p class="mb-2">
                                    <strong>🔍 Análise:</strong> Sua solicitação será analisada pelo professor
                                </p>
                                <p class="mb-2">
                                    <strong>⏰ Prazo:</strong> Você receberá o resultado em até 15 dias úteis
                                </p>
                                <p class="mb-0">
                                    <strong>📧 Notificação:</strong> Caso sua solicitação seja validada, será adicionado <strong>+1 CRÉDITO</strong> à sua conta
                                </p>
                                <div class="mt-2 text-center">
                                    <small class="text-dark h6">📅 Data de envio:</small><br>
                                    <strong>{{ $solicitacao->getDataFormatada() }}</strong>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <!-- Botões de ação -->
                        <div class="d-grid gap-3 d-md-flex justify-content-md-center mt-5 mb-4">
                            <!-- Botão: Voltar ao menu principal -->
                            <a href="{{ route ('alunos.home') }}" class="btn btn-primary btn-lg me-md-3">
                                <i class="fa-solid fa-house"></i> Voltar para o Menu
                            </a>
                            
                            <!-- Botão: Fazer nova solicitação -->
                            <a href="{{ route('alunos.solicitacao.index') }}" class="btn btn-success btn-lg">
                                <i class="bi bi-plus-circle"></i> Fazer uma nova solicitação
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    </body>
</html>