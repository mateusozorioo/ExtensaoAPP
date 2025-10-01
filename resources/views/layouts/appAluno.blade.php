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

    <body class="bg-light d-flex flex-column min-vh-100">

        {{-- HEADER --}}
        @include('includes.headerAluno')

        {{-- CONTEÚDO PRINCIPAL --}}
        <!--Faz o conteúdo principal crescer e ocupar o espaço disponível-->
        <main class="flex-grow-1">
            @yield('content')
        </main>

        <!--Faz o conteúdo principal crescer e ocupar o espaço disponívels-->
        <footer class="d-flex justify-content-between align-items-center px-3 py-1 mt-3"
            style="background-color: #d46d00;">
            @include('includes.footer')
        </footer>
    </body>

    </html>