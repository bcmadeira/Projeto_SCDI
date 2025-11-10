@extends('layouts.app')

@section('title', 'Cadastro de Doador - SCDI')

@push('styles')
<style>
    .form-container {
        max-width: 600px;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="container-center">
    <div class="form-container">
        <!-- Logo e título do sistema -->
        <div class="logo-header">
            <img src="{{ asset('frontend/assets/images/logo sem a escrita.png') }}" alt="SCDI Logo" class="logo-img">
            <div class="logo-text">
                <div class="logo-title">SCDI</div>
                <div class="logo-subtitle">Sistema de Controle de Doação Institucional</div>
            </div>
        </div>

        <!-- Título do formulário -->
        <div class="form-title">Bem-vindo</div>
        <div class="form-subtitle">Preencha os campos para se cadastrar</div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulário de cadastro -->
        <form id="doadorForm" action="{{ route('doador.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" class="form-input" value="{{ old('nome') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="sobrenome">Sobrenome</label>
                    <input type="text" id="sobrenome" name="sobrenome" class="form-input" value="{{ old('sobrenome') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" class="form-input" placeholder="000.000.000-00" value="{{ old('cpf') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="telefone">Telefone</label>
                    <input type="tel" id="telefone" name="telefone" class="form-input" placeholder="(00) 00000-0000" value="{{ old('telefone') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco" class="form-input" value="{{ old('endereco') }}" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="cidade">Cidade</label>
                    <input type="text" id="cidade" name="cidade" class="form-input" value="{{ old('cidade') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="cep">CEP</label>
                    <input type="text" id="cep" name="cep" class="form-input" placeholder="00000-000" value="{{ old('cep') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="senha">Senha</label>
                <input type="password" id="senha" name="senha" class="form-input" required>
            </div>

            <button type="submit" class="btn-primary">CADASTRAR</button>
            <a href="{{ route('cadastrar') }}" class="btn-secondary">VOLTAR</a>
        </form>
    </div>
</div>
@endsection

@push('scripts')
{{-- <script src="{{ asset('frontend/js/doador-cadastro.js') }}"></script> --}}
@endpush
