@extends('layouts.app')

@section('titulo_pagina')
    <i class="fas fa-receipt"></i> Helpdesk
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="filtroNumero">Número</label>
                            <input type="number" class="form-control" name="filtroNumero" id="filtroNumero" min="0">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="filtroDescricao">Título</label>
                            <input type="text" class="form-control" name="filtroTitulo" id="filtroTitulo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="filtroCategoria">Categoria</label>
                            <select class="form-control" name="filtroCategoria" id="filtroCategoria">
                                <option value="._.">Selecione Uma Categoria</option>
                                @foreach($categorias as $categoria)
                                    <option
                                        value="{{ $categoria->categoria_codigo }}">{{ $categoria->categoria_descricao }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="filtroStatus">Status</label>
                            <select class="form-control" name="filtroStatus" id="filtroStatus">
                                <option value="._.">Selecione Um Status</option>
                                @foreach($status as $status)
                                    <option
                                        value="{{ $status->status_codigo }}">{{ $status->status_descricao }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="filtroDataIni">Data de Abertura - Inicial</label>
                            <input type="date" class="form-control" name="filtroDataIni" id="filtroDataIni" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="filtroDataFim">Data de Abertura - Final</label>
                            <input type="date" class="form-control" name="filtroDataFim" id="filtroDataFim" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="filtroCliente">Cliente</label>
                            <select class="form-control" name="filtroCliente" id="filtroCliente">
                                <option value="._.">Selecione Um Cliente</option>
                                @foreach($clientes as $cliente)
                                    <option
                                        value="{{ $cliente->credencial_codigo }}">{{ $cliente->credencial_nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="filtroAtendente">Atendente</label>
                            <select class="form-control" name="filtroAtendente" id="filtroAtendente">
                                <option value="._.">Selecione Um Atendente</option>
                                @foreach($atendentes as $atendente)
                                    <option
                                        value="{{ $atendente->credencial_codigo }}">{{ $atendente->credencial_nome }}</option>
                                @endforeach
                            </select>
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

                <div class="row">
                    <div class="col-md-2">
                        @can('helpdesk.create')
                            <a class="btn btn-primary float-left mb-2" href="{{ route('helpdesk.create') }}"><i
                                    class="fas fa-plus"></i> Novo Chamado </a>
                        @endcan
                    </div>
                </div>

                <table class="table table-bordered table-striped table-hover table-condensed tabela_helpdesk">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Data Abertura</th>
                        <th>Título</th>
                        <th>Usuário</th>
                        <th>Atendente</th>
                        <th>Status</th>

                        @if(Auth::user()->can('helpdesk.edit') || Auth::user()->can('helpdesk.destroy') || Auth::user()->can('helpdesk.show'))
                            <th colspan="100" style="min-width: 80px; max-width: 80px; width: 80px;">Ações</th>
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

    @include('helpdesk.script')

    <script>
        window.onload = setInterval("lista.do_buscar()", 60000);

        $(document).ready(function () {

            $('.btnPesquisa').click(function () {
                lista.do_buscar();
            });

            $('.btnPesquisa ').click();

        });
    </script>
@endsection

