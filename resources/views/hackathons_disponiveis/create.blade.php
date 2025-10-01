<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Hackathon Disponível</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
</head>

<body class="bg-secondary">
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow bg-light border-light" style="width: 35rem;">
            <!-- Cabeçalho do card com gradiente laranja -->
            <div class="card-header text-white" style="background: linear-gradient(45deg, #ff6b35, #f7931e);">
                <h1 class="h5 mb-0 text-center">Novo Hackathon Disponível</h1>
            </div>

            <div class="card-body">

                <!-- Formulário com validação Bootstrap e proteção CSRF -->
                <form action="{{ route('hackathons-disponiveis.store') }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    <!-- Token de segurança do Laravel para proteção contra ataques CSRF -->
                    @csrf

                    <!-- Campo Nome do Hackathon -->
                    <div class="mb-3">
                        <label for="nome" class="form-label text-dark">Nome do Hackathon</label>
                        <!-- Grupo de input com ícone -->
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-trophy-fill"></i></span>
                            <!-- Input para o nome do hackathon -->
                            <input type="text" name="nome" id="nome" 
                                   class="form-control @error('nome') is-invalid @enderror" 
                                   placeholder="Ex: Hackathon de Inovação 2025"
                                   value="{{ old('nome') }}"
                                   maxlength="100" required>
                            <!-- Mensagem de erro para validação -->
                            <div class="invalid-feedback">
                                <!-- Se há erro, mostra a mensagem personalizada do controller -->
                                @error('nome')
                                    {{ $message }}
                                <!--Se não há erro, mostra mensagem padrão-->
                                @else
                                    Por favor, informe o nome do hackathon.
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Campo Link de Inscrição -->
                    <div class="mb-3">
                        <label for="link" class="form-label text-dark">Link de Inscrição</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
                            <!-- Input para o link onde os alunos vão se inscrever -->
                            <input type="url" name="link" id="link" 
                                   class="form-control @error('link') is-invalid @enderror"
                                   placeholder="Ex: https://exemplo.com/inscricao"
                                   value="{{ old('link') }}" required>
                            <div class="invalid-feedback">
                                @error('link')
                                    {{ $message }}
                                @else
                                    Por favor, informe um link válido para inscrição.
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Campo Imagem do Hackathon -->
                    <div class="mb-4">
                        <label for="imagem" class="form-label text-dark">Imagem do Hackathon</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-image-fill"></i></span>
                            <!-- Input para upload da imagem ilustrativa do hackathon -->
                            <input type="file" name="imagem" id="imagem" 
                                   class="form-control @error('imagem') is-invalid @enderror" 
                                   accept="image/*" required>
                            <div class="invalid-feedback">
                                @error('imagem')
                                    {{ $message }}
                                @else
                                    Por favor, selecione uma imagem para o hackathon.
                                @enderror
                            </div>
                        </div>
                        <!-- Texto de ajuda para orientar sobre o formato da imagem -->
                        <div class="form-text">Formatos aceitos: JPG, PNG, GIF. Tamanho máximo: 2MB.</div>
                        
                        <!-- Preview da imagem -->
                        <div id="image-preview" class="mt-3" style="display: none;">
                            <img id="preview-img" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                        </div>
                    </div>

                    <!-- Botões de ação -->
                    <div class="d-grid gap-2">
                        <!-- Botão para criar o hackathon com gradiente laranja -->
                        <button type="submit" class="btn text-white"
                            style="background: linear-gradient(45deg, #ff6b35, #f7931e);">
                            <i class="bi bi-plus-circle me-2"></i>Criar Hackathon
                        </button>
                        <!-- Botão para voltar à lista de hackathons -->
                        <a href="{{ route('hackathons-disponiveis.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript para funcionalidades interativas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
    // Script de validação do Bootstrap
    // Função anônima executada imediatamente para evitar poluição do escopo global
    (function() {
        // Seleciona todos os formulários que precisam de validação
        const forms = document.querySelectorAll('.needs-validation');

        // Para cada formulário encontrado, adiciona o evento de validação
        forms.forEach(form => {
            // Adiciona listener para o evento de submissão do formulário
            form.addEventListener('submit', event => {
                // Verifica se o formulário é válido
                if (!form.checkValidity()) {
                    // Se não for válido, impede o envio
                    event.preventDefault();
                    event.stopPropagation();
                }
                // Adiciona classe para mostrar os feedbacks de validação
                form.classList.add('was-validated');
            }, false);
        });
    })();

    // Preview da imagem selecionada (funcionalidade melhorada)
    // Disparado quando usuário seleciona/muda arquivo
    // Parâmetro "e": Objeto do evento com informações do arquivo
    document.getElementById('imagem').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');
        
        if (file) {
            // Verifica se é uma imagem
            if (file.type.startsWith('image/')) {
                // Verifica o tamanho do arquivo (2MB = 2097152 bytes)
                if (file.size > 2097152) {
                    alert('A imagem deve ter no máximo 2MB.');
                    this.value = '';
                    preview.style.display = 'none';
                    return;
                }
                
                // Mostra o preview da imagem
                const reader = new FileReader(); //API para ler arquivos no navegador
                reader.onload = function(e) { //Callback executado quando leitura termina
                    previewImg.src = e.target.result;
                    preview.style.display = 'block'; //resultado convertido para URL
                };
                reader.readAsDataURL(file);
                
                console.log('Imagem selecionada:', file.name);
            } else {
                alert('Por favor, selecione apenas arquivos de imagem.');
                this.value = '';
                preview.style.display = 'none';
            }
        } else {
            preview.style.display = 'none';
        }
    });

    // Remove o preview se o usuário limpar o campo
    document.getElementById('imagem').addEventListener('click', function() {
        if (!this.value) {
            document.getElementById('image-preview').style.display = 'none';
        }
    });
    </script>
</body>

</html>