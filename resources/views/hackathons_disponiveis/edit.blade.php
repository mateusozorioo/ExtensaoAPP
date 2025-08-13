@extends('layouts.app')

@section('title', 'Editar Hackathon')

@php
$name = "EDITAR HACKATHON - UNIFIL";
$hideOrangeTitle = true;
$hideMenuText = true;
@endphp

@section('content')

<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">✏️ Editar Hackathon</h4>
                        <a href="{{ route('hackathons-disponiveis.index') }}" class="btn btn-secondary btn-sm">← Voltar</a>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Mensagens de erro -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>x
                        </div>
                    @endif

                    <!-- Imagem atual -->
                    <div class="text-center mb-4">
                        <h5>Imagem Atual:</h5>
                        <img src="{{ asset($hackathon->hackathon_imagem) }}" 
                             alt="{{ $hackathon->hackathon_nome }}"
                             class="img-thumbnail"
                             style="max-height: 200px; object-fit: cover;">
                    </div>

                    <form action="{{ route('hackathons-disponiveis.update', $hackathon->hackathons_disponiveis_id) }}" 
                          method="POST" 
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nome do Hackathon -->
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome do Hackathon *</label>
                            <input type="text" 
                                   class="form-control @error('nome') is-invalid @enderror" 
                                   id="nome" 
                                   name="nome" 
                                   value="{{ old('nome', $hackathon->hackathon_nome) }}" 
                                   required>
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Link de Inscrição -->
                        <div class="mb-3">
                            <label for="link" class="form-label">Link de Inscrição *</label>
                            <input type="url" 
                                   class="form-control @error('link') is-invalid @enderror" 
                                   id="link" 
                                   name="link" 
                                   value="{{ old('link', $hackathon->hackathon_link) }}" 
                                   placeholder="https://exemplo.com" 
                                   required>
                            @error('link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Imagem do Hackathon -->
                        <div class="mb-3">
                            <label for="imagem" class="form-label">Nova Imagem (opcional)</label>
                            <input type="file" 
                                   class="form-control @error('imagem') is-invalid @enderror" 
                                   id="imagem" 
                                   name="imagem" 
                                   accept="image/*">
                            <div class="form-text bg-danger ps-1 text-light">
                                Deixe em branco para manter a imagem atual. 
                                Formatos aceitos: JPEG, PNG, JPG, GIF. Tamanho máximo: 2MB.
                            </div>
                            @error('imagem')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botões -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('hackathons-disponiveis.index') }}" 
                               class="btn btn-secondary me-md-2">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning">
                                ✏️ Atualizar Hackathon
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection