<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Matéria</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="text-center mb-4">
            <h2 class="h4">Editar Matéria</h2>
        </div>

        <!-- Formulário de edição -->
        <form action="{{ route('materia.update', $materia->materia_id) }}" method="POST"
            class="bg-white p-4 border rounded">
            @csrf
            @method('PUT')
            <!-- Necessário para usar método PUT -->

            <!-- Nome da matéria -->
            <div class="mb-3">
                <label for="nome_materia" class="form-label">Nome da Matéria</label>
                <input type="text" name="nome_materia" class="form-control" value="{{ $materia->nome_materia }}"
                    required>
            </div>

            <!-- Bimestre (Cubo) -->
            <div class="mb-3">
                <label for="bimestre_cubo" class="form-label">Bimestre (Cubo)</label>
                <input type="text" name="bimestre_cubo" class="form-control" value="{{ $materia->bimestre_cubo }}"
                    required>
            </div>

            <!-- Botão de confirmar alterações -->
            <button type="submit" class="btn btn-success">✔️ Confirmar Alterações</button>
            <a href="{{ route('materia.index') }}" class="btn btn-secondary">Voltar</a>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>