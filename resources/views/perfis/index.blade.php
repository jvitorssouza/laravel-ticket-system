@extends('layouts.app')

@section('titulo_pagina')
    <i class="fas fa-ban"></i> Perfil de Acesso
@endsection

@section('conteudo')

    <!-- CARD FILTROS -->
    <div class="card card-default">
        <div class="card-header">
            <a class="float-right" href="#" data-tool="card-collapse" data-toggle="tooltip">
                <em class="fa fa-plus"></em>
            </a>
            <div class="card-title" style="font-size: 12px;"><i class="fas fa-filter"></i>Filtros</div>
        </div>
        <div class="card-wrapper collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="filtroDescricao">Descrição</label>
                            <input type="text" class="form-control" name="filtroDescricao" id="filtroDescricao">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btnPesquisa float-right mt-3 mb-3" value="Pesquisar"><i
                        class="fas fa-search"></i> Pesquisar
                </button>
            </div>
        </div>
    </div>
    <!-- FIM CARD FILTROS -->

    <!-- CARD CONTEÚDO -->
    <div class="card card-default cardConteudo">
        <div class="card-wrapper collapse show">
            <div class="card-body table-responsive">

                @can('perfilacesso.create')
                    <a class="btn btn-primary float-left mb-2" href="{{ route('perfilacesso.create') }}"><i
                            class="fas fa-plus"></i> Novo Perfil de Acesso </a>
                @endcan

                <table class="table table-sm table-bordered table-striped table-hover tabela_categorias">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descrição</th>
                        @if(Auth::user()->can('perfilacesso.edit') || Auth::user()->can('perfilacesso.destroy'))
                            <th colspan="100">Ações</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="float-right mt-5 links">

                </div>
            </div>
        </div>
    </div>
    <!-- FIM CARD CONTEÚDO -->
@endsection

@section('scripts')

    @include('perfis.script')

    <script>
        $(document).ready(function () {

            $('.btnPesquisa').click(function () {
                lista.do_buscar();
            });

            $('.btnPesquisa ').click();

        });
    </script>
@endsection
