@extends('layouts.app')

@section('titulo_pagina')
    <i class="fas fa-th"></i> Dashboard
@endsection

@section('conteudo')
    <!-- CARDBOX -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <!-- START card-->
            <div class="card flex-row align-items-center align-items-stretch border-0">
                <div class="col-4 d-flex align-items-center bg-primary-dark justify-content-center rounded-left">
                    <em class="fas fa-cloud fa-3x"></em>
                </div>
                <div class="col-8 py-3 bg-primary rounded-right">
                    <div class="h2 mt-0">1</div>
                    {{--                    <div class="h2 mt-0">{{ $qtd_hlpdesk }}</div>--}}
                    <div class="text-uppercase">Chamado(s)</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <!-- START card-->
            <div class="card flex-row align-items-center align-items-stretch border-0">
                <div class="col-4 d-flex align-items-center bg-purple-dark justify-content-center rounded-left">
                    <em class="fas fa-globe fa-3x"></em>
                </div>
                <div class="col-8 py-3 bg-purple rounded-right">
                    <div class="h2 mt-0">700
                        <small>GB</small>
                    </div>
                    <div class="text-uppercase">Na minha fila</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12">
            <!-- START card-->
            <div class="card flex-row align-items-center align-items-stretch border-0">
                <div class="col-4 d-flex align-items-center bg-green-dark justify-content-center rounded-left">
                    <em class="fas fa-comments fa-3x"></em>
                </div>
                <div class="col-8 py-3 bg-green rounded-right">
                    <div class="h2 mt-0">500</div>
                    <div class="text-uppercase">Reviews</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12">
            <!-- START date widget-->
            <div class="card flex-row align-items-center align-items-stretch border-0">
                <div class="col-4 d-flex align-items-center bg-green justify-content-center rounded-left">
                    <div class="text-center">
                        <div class="text-uppercase text-sm" data-now="" data-format="MMMM"></div>
                        <br>
                        <div class="text-uppercase h2 mt-0" data-now="" data-format="D"></div>
                    </div>
                </div>

                <div class="col-8 py-3 rounded-right">
                    <div class="text-uppercase" data-now="" data-format="dddd"></div>
                    <br>
                    <div class="text-uppercase h2 mt-0" data-now="" data-format="H:mm"></div>
                </div>
            </div>
            <!-- END date widget-->
        </div>
    </div>
    <!-- FIM CARDBOX -->

    <!-- CARD CONTEÚDO -->
    <div class="row">
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-body">
                    <div class="text-info">Chamados Abertos X Chamados Fechados (Este Mês)</div>
                    <div class="text-center py-4">
                        <canvas id="grafico_chamado_aberto_chamado_fechado_mes"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-body">
                    <div class="text-info">Chamados Abertos por Departamentos (Este Mês)</div>
                    <div class="text-center py-4">
                        <canvas id="grafico_chamado_aberto_departamentos_mes"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-body">
                    <div class="text-info">Chamados Abertos por Filial (Este Mês)</div>
                    <div class="text-center py-4">
                        <canvas id="grafico_chamado_aberto_empresas_mes"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- FIM CARD CONTEÚDO -->
@endsection

@section('scripts')
    <script>
        home.do_buscar_graficos();
    </script>
@endsection
