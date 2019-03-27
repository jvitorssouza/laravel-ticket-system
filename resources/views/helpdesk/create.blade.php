@extends('layouts.app')

@section('titulo_pagina')
    <i class="fas fa-align-justify"></i> Cadastro de Chamado
@endsection

@section('conteudo')

    <!-- CARD CONTEÚDO -->
    <div class="card card-default cardConteudo">
        <div class="card-wrapper collapse show">
            <div class="card-body">
                {!! Form::open(['url'=>route('helpdesk.store'), 'id'=>'salvar-helpdesk', 'enctype'=>"multipart/form-data" ]) !!}
                    {{Form::token()}}
                    @include('helpdesk._form')
                    <button type="submit" class="btn btn-primary float-right mt-3 mr-3 mb-3"> <i class="fas fa-save"></i> Salvar </button>
                {!! Form::close() !!}
                <a href="{{ route('helpdesk.index') }}" class="btn btn-danger float-right mt-3 mr-3 mb-3"> <i class="fas fa-arrow-left"></i> Voltar </a>
            </div>
        </div>
    </div>
    <!-- FIM CARD CONTEÚDO -->
@endsection

@section('scripts')
    @include('helpdesk.script')

<script>
    $('.btn-add-file').click(function () {
        $('.div_files').append('<input type="file" class="form-control mt-3" name="fotos[]" multiple accept="image/x-png,image/gif,image/jpeg"/>');
    });

    $('#departamento_codigo').change(function () {
        create.do_buscar_categorias();
    });
</script>


@endsection
