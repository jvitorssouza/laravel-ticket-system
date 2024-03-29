@extends('layouts.app')

@section('titulo_pagina')
    <i class="fas fa-align-justify"></i> Edição de Perfil de Acesso - {{ $perfil->perfil_descricao }}
@endsection

@section('conteudo')

    <!-- CARD CONTEÚDO -->
    <div class="card card-default cardConteudo">
        <div class="card-wrapper collapse show">
            <div class="card-body">
                {!! Form::model($perfil, ['route'=>['perfilacesso.update', $perfil->perfil_codigo], 'method' => 'put','files' => true]) !!}
                    {{Form::token()}}
                    @include('perfis._form')
                    <button type="submit" class="btn btn-primary float-right mt-3 mr-3 mb-3"> <i class="fas fa-save"></i> Salvar </button>
                {!! Form::close() !!}
                    <a href="{{ route('perfilacesso.index') }}" class="btn btn-danger float-right mt-3 mr-3 mb-3"> <i class="fas fa-arrow-left"></i> Voltar </a>
            </div>
        </div>
    </div>
    <!-- FIM CARD CONTEÚDO -->
@endsection

@section('scripts')
    @include('categorias.script')
@endsection
