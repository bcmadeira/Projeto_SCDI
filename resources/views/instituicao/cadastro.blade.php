@extends('layouts.app')

@section('title', 'Cadastro de Instituição - SCDI')

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
    .form-row-3 {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 15px;
    }
    @media (max-width: 768px) {
        .form-row, .form-row-3 {
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
        <div class="form-subtitle">Preencha os dados da sua instituição</div>

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
        <form id="instituicaoForm" action="{{ route('instituicoes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="nome">Nome</label>
                <input type="text" id="nome" name="nome" class="form-input" value="{{ old('nome') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="cnpj">CNPJ</label>
                    <input type="text" id="cnpj" name="cnpj" class="form-input" placeholder="00.000.000/0000-00" value="{{ old('cnpj') }}" required>
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

            <div class="form-row-3">
                <div class="form-group">
                    <label class="form-label" for="cidade">Cidade</label>
                    <input type="text" id="cidade" name="cidade" class="form-input" value="{{ old('cidade') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="estado">Estado</label>
                    <select id="estado" name="estado" class="form-input" required>
                        <option value="">Selecione</option>
                        <option value="AC" {{ old('estado') == 'AC' ? 'selected' : '' }}>AC</option>
                        <option value="AL" {{ old('estado') == 'AL' ? 'selected' : '' }}>AL</option>
                        <option value="AP" {{ old('estado') == 'AP' ? 'selected' : '' }}>AP</option>
                        <option value="AM" {{ old('estado') == 'AM' ? 'selected' : '' }}>AM</option>
                        <option value="BA" {{ old('estado') == 'BA' ? 'selected' : '' }}>BA</option>
                        <option value="CE" {{ old('estado') == 'CE' ? 'selected' : '' }}>CE</option>
                        <option value="DF" {{ old('estado') == 'DF' ? 'selected' : '' }}>DF</option>
                        <option value="ES" {{ old('estado') == 'ES' ? 'selected' : '' }}>ES</option>
                        <option value="GO" {{ old('estado') == 'GO' ? 'selected' : '' }}>GO</option>
                        <option value="MA" {{ old('estado') == 'MA' ? 'selected' : '' }}>MA</option>
                        <option value="MT" {{ old('estado') == 'MT' ? 'selected' : '' }}>MT</option>
                        <option value="MS" {{ old('estado') == 'MS' ? 'selected' : '' }}>MS</option>
                        <option value="MG" {{ old('estado') == 'MG' ? 'selected' : '' }}>MG</option>
                        <option value="PA" {{ old('estado') == 'PA' ? 'selected' : '' }}>PA</option>
                        <option value="PB" {{ old('estado') == 'PB' ? 'selected' : '' }}>PB</option>
                        <option value="PR" {{ old('estado') == 'PR' ? 'selected' : '' }}>PR</option>
                        <option value="PE" {{ old('estado') == 'PE' ? 'selected' : '' }}>PE</option>
                        <option value="PI" {{ old('estado') == 'PI' ? 'selected' : '' }}>PI</option>
                        <option value="RJ" {{ old('estado') == 'RJ' ? 'selected' : '' }}>RJ</option>
                        <option value="RN" {{ old('estado') == 'RN' ? 'selected' : '' }}>RN</option>
                        <option value="RS" {{ old('estado') == 'RS' ? 'selected' : '' }}>RS</option>
                        <option value="RO" {{ old('estado') == 'RO' ? 'selected' : '' }}>RO</option>
                        <option value="RR" {{ old('estado') == 'RR' ? 'selected' : '' }}>RR</option>
                        <option value="SC" {{ old('estado') == 'SC' ? 'selected' : '' }}>SC</option>
                        <option value="SP" {{ old('estado') == 'SP' ? 'selected' : '' }}>SP</option>
                        <option value="SE" {{ old('estado') == 'SE' ? 'selected' : '' }}>SE</option>
                        <option value="TO" {{ old('estado') == 'TO' ? 'selected' : '' }}>TO</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="cep">CEP</label>
                    <input type="text" id="cep" name="cep" class="form-input" placeholder="00000-000" value="{{ old('cep') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" class="form-input" rows="4" placeholder="Descreva brevemente a instituição e seus objetivos">{{ old('descricao') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="senha">Senha</label>
                <input type="password" id="senha" name="senha" class="form-input" required>
            </div>

            <button type="submit" class="btn-primary">CADASTRAR</button>
            <a href="{{ route('welcome') }}" class="btn-secondary">VOLTAR</a>
        </form>
    </div>
</div>
@endsection

@push('scripts')
{{-- <script src="{{ asset('frontend/js/instituicao-cadastro.js') }}"></script> --}}
@endpush
