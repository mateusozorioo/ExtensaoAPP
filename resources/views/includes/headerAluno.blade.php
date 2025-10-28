<!-- resources/views/includes/headerAluno.blade.php -->

<header class="m-3 mt-0 bg-light">

    <!--Linha do Título-->
    <div class="container">
        <div class="my-2">
            <div class="row d-flex align-items-center">
                <div class="col-12 col-md-4 text-center mb-3 mb-md-0">
                    <img src="{{ asset('images/logoUnifil.png') }}" width="100" class="img-fluid" alt="Logo-Unifil">
                </div>
                <div class="col-12 col-md-4 text-center mb-6 mb-md-0">
                    <h1 class="fw-bold" style="font-size: 50px;">Extensão APP</h1>
                </div>
                <div class="col-8 col-md-3 mb-3 mb-md-0">
                    <div class="d-flex py-2 align-items-center rounded-pill justify-content-between"
                        style="background-color: #FF9500;">
                        <i class="fa-regular fa-circle-user ps-3 text-white" style="font-size: 2rem;"></i>
                        <div class="text-white text-center flex-grow-1 pe-4">
                            {{-- Usando a variável do View Composer --}}
                            <div class="fw-bold">{{ $nomeAluno ?? 'Nome não disponível' }}</div>
                            <small class="opacity-90">Aluno</small>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-1 mb-3 mb-md-0">
                    <div class="card bg-info">
                        <div class="card-header text-center bg-secondary text-white h6 px-1 py-1">
                            CRÉDITOS
                        </div>
                        <div class="card-body text-center p-1">
                            {{-- Usando a variável de créditos do View Composer --}}
                            <b class="fs-4">{{ $creditosAluno ?? 0 }}</b>         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu -->
    <div class="mt-1">
        <nav class="row nav rounded mb-3" style="background-color:rgb(76, 76, 76); @if(isset($hideMenuText) && $hideMenuText) min-height: 40px; @endif">
            @if(!isset($hideMenuText) || !$hideMenuText)
            <div class="col-5 d-flex justify-content-end">
                <a href="{{ route('alunos.hackathons') }}"
                class="nav-link {{ request()->routeIs('alunos.hackathons') ? 'text-white fw-bold' : 'text-light' }}">
                HACKATHONS UNIFIL
                </a>
            </div>
            <div class="col-2 d-flex justify-content-center">
                <a href="{{ route('alunos.home') }}"
                    class="nav-link {{ request()->routeIs('alunos.home') ? 'text-white fw-bold' : 'text-light' }}">
                    MENU
                </a>
            </div>    
            <div class="col-5 d-flex justify-content-start">    
                <a href="{{ route('alunos.materia.index') }}"
                    class="nav-link {{ request()->routeIs('alunos.materia.index') ? 'text-white fw-bold' : 'text-light' }}">
                    MATÉRIA
                </a>
            </div>
            @endif
        </nav>
    </div>

    @if(!isset($hideOrangeTitle) || !$hideOrangeTitle)
        <div class="container mt-4">
            <div class="row">
                <h1 class="h3 text-center text-white bg-gradient p-3 rounded"
                    style="background: linear-gradient(45deg, #ff6b35, #f7931e) !important;">{{ $name ?? 'Sistema de Extensão' }}</h1>
            </div>
        </div>
    @endif

</header>