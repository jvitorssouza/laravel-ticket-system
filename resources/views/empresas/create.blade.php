@extends('layouts.app')

@section('titulo_pagina')
    <i class="fas fa-align-justify"></i> Cadastro de Empresa
@endsection

@section('conteudo')

    <!-- CARD CONTEÚDO -->
    <div class="card card-default cardConteudo">
        <div class="card-wrapper collapse show">
            <div class="card-body">
                {!! Form::open(['url'=>route('empresas.store'), 'id'=>'salvar-empresa' ]) !!}
                    {{Form::token()}}
                    @include('empresas._form')
                    <button type="submit" class="btn btn-primary float-right mt-3 mr-3 mb-3"> <i class="fas fa-save"></i> Salvar </button>
                {!! Form::close() !!}
                <a href="{{ route('empresas.index') }}" class="btn btn-danger float-right mt-3 mr-3 mb-3"> <i class="fas fa-arrow-left"></i> Voltar </a>
            </div>
        </div>
    </div>
    <!-- FIM CARD CONTEÚDO -->
@endsection

@section('scripts')
    @include('empresas.script')
@endsection
