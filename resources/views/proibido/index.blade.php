<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Negado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 4rem;"></i>
                        </div>
                        <h1 class="card-title text-danger mb-3">Acesso Negado</h1>
                        <p class="card-text text-muted mb-2">
                            Desculpe, apenas emails institucionais <strong>@unifil.br</strong> e <strong>@edu.unifil.br</strong> podem acessar este sistema.
                        </p>
                        <p class="card-text text-muted mb-4">
                            Por favor, faça login com sua conta institucional.
                        </p>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-arrow-clockwise me-2"></i>Tentar Novamente
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</body>
</html>