<!-- resources/views/includes/header.blade.php -->

<header class="m-3 mt-0 bg-light">

    <!--Linha do Título-->
    <div class="container">
        <form class="mb-2 mt-2">
            <div class="row align-items-center">
                <div class="col-12 col-md-3 text-center mb-3 mb-md-0">
                    <img src="{{ asset('images/logoUnifil.png') }}" width="100" class="img-fluid" alt="Logo-Unifil">
                </div>
                <div class="col-12 col-md-6 text-center mb-6 mb-md-0">
                    <h1 class="fw-bold" style="font-size: 70px;">Extensão APP</h1>
                </div>
                <div class="col-12 col-md-3 mb-3 mb-md-0">
                    <div class="d-flex py-2 align-items-center rounded-pill justify-content-between"
                        style="background-color: #FF9500;">
                        <i class="fa-regular fa-circle-user ps-4 text-white" style="font-size: 2rem;"></i>
                        <div class="text-white text-center flex-grow-1 pe-4">
                            <div class="fw-bold">{{ $nomeProfessor ?? 'Nome não disponível' }}</div>
                            <small class="opacity-90">Professor</small>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Menu -->
    <div class="mt-1">
        <nav class="nav justify-content-center rounded mb-3" style="background-color:rgb(76, 76, 76); @if(isset($hideMenuText) && $hideMenuText) min-height: 40px; @endif">
            @if(!isset($hideMenuText) || !$hideMenuText)
                <a href="{{ route('hackathons-disponiveis.index') }}"
                    class="nav-link {{ request()->routeIs('hackathons-disponiveis.index') ? 'text-white fw-bold' : 'text-light' }}">
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
            @endif
        </nav>
    </div>

    @if(!isset($hideOrangeTitle) || !$hideOrangeTitle)
        <div class="container mt-4">
            <div class="row">
                <h1 class="h3 text-center text-white bg-gradient p-3 rounded"
                    style="background: linear-gradient(45deg, #ff6b35, #f7931e) !important;">{{ $name }}</h1>
            </div>
        </div>
    @endif

</header>