<!-- Formulário simples para ser a base do primeiro CRUD do meu projeto -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Matéria</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h4 mb-0"><i class="bi bi-journal-plus me-2"></i>Cadastrar Matéria</h1>
                    </div>
                    <div class="card-body">
                        <!-- Exibe a mensagem de sucesso, se houver -->
                        @if(session('sucess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('sucess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Fechar"></button>
                        </div>
                        @endif

                        <form action="{{ route ('materia.store') }}" method="post" class="needs-validation" novalidate>
                            @csrf

                            <div class="mb-3">
                                <label for="nome_materia" class="form-label">Nome da Matéria</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-book"></i></span>
                                    <input type="text" class="form-control" name="nome_materia" id="nome_materia"
                                        placeholder="Ex: Projeto Interdisciplinar I" required>
                                    <div class="invalid-feedback">
                                        Por favor, informe o nome da matéria.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="bimestre_cubo" class="form-label">Bimestre (Cubo)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar-range"></i></span>
                                    <input type="text" class="form-control" name="bimestre_cubo" id="bimestre_cubo"
                                        placeholder="Ex: B1" required>
                                    <div class="invalid-feedback">
                                        Por favor, informe o bimestre.
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i>Cadastrar
                                </button>
                                <a href="#" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Voltar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Validação de formulário -->
    <script>
    // Script para ativar a validação de formulários do Bootstrap
    (function() {
        'use strict'

        // Fetch all forms to which we want to apply validation
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
    </script>
</body>

</html>