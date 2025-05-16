<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Matérias</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="justify-content-between align-items-center mb-4">
            <div class="row justify-content-end">
                <h1 class="col-8 h3 text-center">Lista de Matérias</h1>
                <!-- Botão de adicionar nova matéria -->
                <a href="{{ route('materia.create') }}" class="col-2 btn btn-primary">+ Nova Matéria</a>
            </div>
        </div>

        <!-- Mensagem de sucesso -->
        @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
        @endif

        <!-- Tabela de matérias -->
        <div class="border rounded text-center">
            <div class="">
                <table class="table table-bordered mb-0">
                    <thead class="h5 table-light">
                        <tr class="border border-4 border-black rounded">
                            <th class="border-end border-4 border-black">Nome da Matéria</th>
                            <th class="border-end border-4 border-black">Bimestre (Cubo)</th>
                            <th>Ações</th> <!-- Nova coluna -->
                        </tr>
                    </thead>
                    <tbody class="table-secondary">
                        @forelse ($materias as $materia)
                        <tr class="border border-4 border-black rounded">
                            <td class="border-end border-4 border-black">{{ $materia->nome_materia }}</td>
                            <td class="border-end border-4 border-black">{{ $materia->bimestre_cubo }}</td>
                            <td>
                                <!-- Botão de edição -->
                                <!-- Para cada $materia -> materia_id é gerado os botões, que podem ser identificados pelo seu materia_id -->
                                <a href="{{ route('materia.edit', $materia->materia_id) }}"
                                    class="btn btn-sm btn-warning">
                                    ✏️ Editar
                                </a>
                                <!-- Botão de exclusão -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $materia->materia_id }}">
                                    ❌ Excluir
                                </button>

                                <!-- Modal de confirmação de exclusão -->
                                <div class="modal fade" id="deleteModal{{ $materia->materia_id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $materia->materia_id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-center w-100"
                                                    id="deleteModalLabel{{ $materia->materia_id }}">
                                                    Confirmar Exclusão</h5>
                                                <!-- data-bs-dismiss="modal": fecha o modal ao clicar -->
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Fechar"></button>
                                            </div>
                                            <div class="modal-body">
                                                Tem certeza que deseja excluir a matéria
                                                <strong>{{ $materia->nome_materia }}</strong> permanentemente?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('materia.destroy', $materia->materia_id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Sim</button>
                                                    <!-- data-bs-dismiss="modal": fecha o modal ao clicar -->
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Não</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Nenhuma matéria cadastrada.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS (opcional, caso queira usar interações no futuro) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>