<!-- resources/views/includes/header.blade.php -->

<header class="m-3 mt-0 bg-light">
    <div class="container-fluid mx-3 px-3 mt-3">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-12 col-md-3">
                <img src="{{ asset('images/logoUnifil.png') }}" alt="Logo-Unifil" height="100" class="">
            </div>

            <!-- Título centralizado -->
            <div class="col-12 col-md-6 text-center">
                <h1 class="fw-bold" style="font-size: 70px;">Extensão APP</h1>
            </div>

            <!-- Card do usuário -->
            <div class="col-12 col-md-3">
                <div class="d-flex py-2 align-items-center text-center rounded-pill" style="background-color: #FF9500;">
                    <i class="fa-regular fa-circle-user px-4 text-white me-3" style="font-size: 2rem;"></i>
                    <div class="text-white">
                        <div class="fw-bold">Mario Akihiko</div>
                        <small class="opacity-90">Professor</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu -->
    <div class="mt-1">
        <nav class="nav justify-content-center rounded" style="background-color:rgb(76, 76, 76);">
            <a class="nav-link {{ request()->is('hackathons') ? 'text-white fw-bold' : 'text-light' }}" href="#">
                HACKATHONS UNIFIL
            </a>
            <a href="{{ route('professor.home') }}"
                class="nav-link {{ request()->routeIs('professor.home') ? 'text-white fw-bold' : 'text-light' }}">
                MENU
            </a>
            <a href="{{ route('materia.index') }}"
                class="nav-link {{ request()->routeIs('materia.index') ? 'text-white fw-bold' : 'text-light' }}">
                GERENCIAR MATÉRIAS
            </a>
        </nav>
    </div>

</header>