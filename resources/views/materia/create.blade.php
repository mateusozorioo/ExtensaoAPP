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

<body class="bg-secondary">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow bg-light border-light" style="width: 35rem;">
            <div class="card-header text-white" style="background: linear-gradient(45deg, #ff6b35, #f7931e);">
                <h1 class="h5 mb-0 text-center"><i class="bi bi-plus-square me-2"></i>Cadastrar Matéria</h1>
            </div>
            <div class="card-body">
                <!--Adiciona classe do Bootstrap para validação de formulário e desabilita a validação do navegador-->
                <form action="{{ route('materia.store') }}" method="POST" class="needs-validation" novalidate>
                    <!--diretiva do Laravel que gera um token de segurança para proteger contra ataques CSRF (falsificação de requisição)-->
                    @csrf
                    <!-- Campo Nome da Matéria -->
                    <div class="mb-3">
                        <label for="nome_materia" class="form-label text-dark">Nome da Matéria</label>
                        <!--o 'input-group' serve para agrupar o ícone com o input-->
                        <div class="input-group">
                            <!--input-group-text: estiliza o container do ícone-->
                            <span class="input-group-text"><i class="bi bi-mortarboard-fill"></i></span>
                            <!-- name="nome_materia": nome que será enviado para o servidor, id="nome_materia": identificador único -->
                            <input type="text" name="nome_materia" id="nome_materia" class="form-control"
                                placeholder="Ex: Projeto Interdisciplinar I" maxlength="255" required>
                            <div class="invalid-feedback">Por favor, informe o nome da matéria.</div>
                        </div>
                    </div>

                    <!-- Campo Bimestre -->
                    <div class="mb-4">
                        <label for="bimestre_cubo" class="form-label text-dark">Bimestre (Cubo)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar2-week-fill"></i></span>
                            <input type="text" class="form-control" name="bimestre_cubo" id="bimestre_cubo"
                                placeholder="Ex: B1" maxlength="2" required>
                            <div class="invalid-feedback">Por favor, informe o bimestre.</div>
                        </div>
                    </div>

                    <!-- Botões -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn" style="background: linear-gradient(45deg, #ff6b35, #f7931e);">
                            <i class="bi bi-save me-2"></i>Cadastrar
                        </button>
                        <a href="{{ route('materia.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
    // Validação Bootstrap
    // Os parênteses ao redor criam uma função anônima que executa imediatamente
    // Isso evita poluir o escopo global com variáveis
    (function() {
        // Busca TODOS os formulários da página que tenham a classe 'needs-validation'
        // querySelectorAll retorna uma NodeList (similar a um array) com todos os elementos encontrados
        const forms = document.querySelectorAll('.needs-validation');
        // Loop. Para cada formulário, executa a função que recebe o formulário como parâmetro
        forms.forEach(form => {
            // ADICIONA EVENTO DE SUBMISSÃO ('submit')
            form.addEventListener('submit', event => {
                // VERIFICAÇÃO DE VALIDADE
                if (!form.checkValidity()) {
                    // Se o formulário não é válido, impede que seja enviado
                    event.preventDefault();
                    // Impede que outros eventos de submit sejam executados
                    event.stopPropagation();
                }
                // ADICIONA CLASSE DE VALIDAÇÃO
                // 'was-validated' é uma classe do Bootstrap que:
                // - Mostra as mensagens de erro (invalid-feedback)
                // - Mostra bordas vermelhas nos campos inválidos
                // - Mostra bordas verdes nos campos válidos
                // Esta classe é adicionada independentemente da validação passar ou não
                form.classList.add('was-validated');
            }, false); // false = não captura o evento na fase de captura
        });
    })();
    </script>
</body>

</html>