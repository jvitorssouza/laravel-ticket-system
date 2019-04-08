@extends('layouts.app')

@section('titulo_pagina')
    <i class="fas fa-align-justify"></i> Edição de Chamado - Nº {{ $helpdesk->helpdesk_codigo }}
@endsection

@section('conteudo')

    <!-- CARD CONTEÚDO -->
    <div class="card card-default cardConteudo">
        <div class="card-wrapper collapse show">
            <div class="card-body">
                {!! Form::model($helpdesk, ['route'=>['helpdesk.update', $helpdesk->helpdesk_codigo], 'method' => 'put','files' => true]) !!}
                {{Form::token()}}
                @include('helpdesk._form')


                <div class="col-md-12 mt-3">
                    <div class="row">
                        @if(isset($imagens))
                            @foreach ($imagens as $img)
                                <div class="col-md-2">
                                    <div class="card card-imagem" style="width:150px">
                                        <img class="card-img-top" src="{{ asset('storage/helpdesk/'.$img->anexos_caminho) }}" alt="Card image">
                                        <div class="card-body">
                                            <a class="btn btn-danger btn-rem-file" style="color: #fff;" data-id="{{ $img->anexos_codigo }}"><i class="fas fa-trash"></i> Remover</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-primary float-right mt-3 mr-3 mb-3"><i class="fas fa-save"></i>
                    Salvar
                </button>
                {!! Form::close() !!}
                <a href="{{ route('helpdesk.index') }}" class="btn btn-danger float-right mt-3 mr-3 mb-3"> <i
                        class="fas fa-arrow-left"></i> Voltar </a>
            </div>
        </div>
    </div>
    <!-- FIM CARD CONTEÚDO -->
@endsection

@section('scripts')
    @include('helpdesk.script')

    <script>
        $('.btn-add-file').click(function () {
            $('.div_files').append('<input type="file" class="form-control mt-3" name="fotos[]" multiple accept="image/x-png,image/gif,image/jpeg" />');
        })

        $('.btn-rem-file').click(function () {
            $('.div_files').append('<input type="text" class="form-control mt-3 hide" name="fotos_remover[]" value="' + $(this).attr('data-id') + '"/>');
            $(this).parents('.card-imagem').remove();
        })
    </script>

    @if(isset($helpdesk->categoria_codigo) && $helpdesk->categoria_departamento != '')
        <script>
            $('#categoria_codigo').val('{{ $helpdesk->categoria_codigo }}').change();
        </script>
    @endif
@endsection
