@extends('layouts.app')

@section('titulo_pagina')
    <i class="fas fa-ban"></i> Cadastro de Perfil de Acesso
@endsection

@section('conteudo')

    <!-- CARD CONTEÚDO -->
    <div class="card card-default cardConteudo">
        <div class="card-wrapper collapse show">
            <div class="card-body">
                {!! Form::open(['url'=>route('perfilacesso.store'), 'id'=>'salvar-categoria' ]) !!}
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
    @include('perfis.script')
    <script>
        $('#my-select').multiSelect();
    </script>
@endsection
