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
                    <em class="fas fa-receipt fa-3x"></em>
                </div>
                <div class="col-8 py-3 bg-primary rounded-right">
                    <div class="h2 mt-0">{{ $qtd_helpdesk_aberto }}</div>
                    <div class="text-uppercase"><a href="{{ route('helpdesk.index') }}" style="color: white;"> Chamado(s) </a></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <!-- START card-->
            <div class="card flex-row align-items-center align-items-stretch border-0">
                <div class="col-4 d-flex align-items-center bg-purple-dark justify-content-center rounded-left">
                    <i class="fas fa-spinner fa-3x"></i>
                </div>
                <div class="col-8 py-3 bg-purple rounded-right">
                    <div class="h2 mt-0">{{ $qtd_helpdesk_aguardando }}</div>
                    <div class="text-uppercase">Aguardando Atend.</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12">
            <!-- START card-->
            <div class="card flex-row align-items-center align-items-stretch border-0">
                <div class="col-4 d-flex align-items-center bg-green-dark justify-content-center rounded-left">
                    <i class="fas fa-headset fa-3x"></i>
                </div>
                <div class="col-8 py-3 bg-green rounded-right">
                    <div class="h2 mt-0">{{ $qtd_helpdesk_atendimento }}</div>
                    <div class="text-uppercase">Em Atendimento</div>
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
                    <div class="text-info">Chamados Abertos por Status</div>
                    <div class="text-center py-4">
                        <canvas id="grafico_chamado_aberto_status_mes"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-body">
                    <div class="text-info">Chamados Abertos por Categorias</div>
                    <div class="text-center py-4">
                        <canvas id="grafico_chamado_aberto_categorias_mes"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-body">
                    <div class="text-info">Chamados Abertos por Departamentos</div>
                    <div class="text-center py-4">
                        <canvas id="grafico_chamado_aberto_departamentos_mes"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-body">
                    <div class="text-info">Chamados Abertos por Filial</div>
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
