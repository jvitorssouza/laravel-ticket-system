@extends('layouts.app')

@section('folha_estilo')
    <link rel="stylesheet" href="{{ asset('assets/css/timeline.css') }}" id="maincss">
@endsection

@section('titulo_pagina')
    <i class="fas fa-receipt"></i> Helpdesk
@endsection

@section('conteudo')

    <!-- CARD CONTEÚDO -->
    <div class="row">
        <div class="col-xl-8">
            <!-- Main card-->
            <div class="card b">
                <div class="card-header">
                    <div class="float-right mt-2">
                        <div
                            class="badge {{ $helpdesk->status->status_classe}}">{{ $helpdesk->status->status_descricao }}</div>
                    </div>
                    <h4 class="my-2">
                        <span>{{ $helpdesk->helpdesk_titulo }}</span>
                    </h4>
                </div>
                <div class="card-body bt"></div>
                <div class="card-body">
                    <p> {{ $helpdesk->helpdesk_detalhes }}</p>
                </div>

                <div class="container-fluid" style="padding: 10px;">
                    <p>
                        @foreach($anexos as $key => $value)
                            <a href="{{ asset('storage/helpdesk/'.$value->anexos_caminho) }}" class="fancybox" data-fancybox-group="gallery">
                                <img src="{{ asset('storage/helpdesk/'.$value->anexos_caminho) }}" width="100px" height="100px" style="border-radius: 10px;" class="mr-1 ml-1 mt-2"/>
                            </a>
                        @endforeach
                    </p>
                </div>

                @if ($helpdesk->status_codigo == 2)
                    {!! Form::open(['url'=>route('helpdesk.inserir_interacao'), 'id'=>'salvar-interacao', 'enctype'=>"multipart/form-data", 'method'=>"POST", 'class'=>"mb-4"]) !!}
                    {{Form::token()}}
                        <div class="col-md-12">
                            <input type="hidden" class="form-control" name="helpdesk_codigo" value="{{ $helpdesk->helpdesk_codigo }}">
                            <input type="hidden" class="form-control" name="credencial_codigo" value="{{ Auth::user()->credencial_codigo }}">
                            <textarea class="form-control" name="interacoes_descricao" id="interacoes_descricao"></textarea>
                            <button type="submit" class="btn btn-primary mt-3 float-right"><i class="fas fa-plus"></i> Inserir Interação</button>
                        </div>
                    {!! Form::close() !!}
                @endif

                <div class="container-fluid">
                    <div class="col-md-12">
                        <ul class="timeline">

                            <?php $ultima_classe = 'timeline-inverted' ?>

                            @foreach($interacoes as $key => $value)

                                <li class="{{ ($ultima_classe == '' ? "timeline-inverted":"") }}">
                                    <div class="timeline-panel">
                                        <div class="timeline-heading mt-2">
                                            <h4>{{ $value->credencial_nome }}</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p style="text-align: justify">{{ $value->interacoes_descricao }}</p>
                                        </div>
                                        <div class="timeline-footer">
                                            <p class="text-right">{{ Utils::formatDate($value->created_at, 'Y-m-d H:i:s', 'd/m/Y') }}</p>
                                        </div>
                                    </div>
                                </li>

                                @if($ultima_classe == '')
                                    <?php $ultima_classe = 'timeline-inverted' ?>
                                @else
                                    <?php $ultima_classe = '' ?>
                                @endif

                            @endforeach

                            <li class="clearfix no-float"></li>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- End Main card-->
        </div>

        <div class="col-xl-4">
            <!-- Aside card-->
            <div class="card b">
                @can('helpdesk.atender_chamado')
                    @if( $helpdesk->status_codigo === 1  || $helpdesk->status_codigo != 4 || $helpdesk->credencial_codigo_cliente === Auth::user()->credencial_codigo)
                        <div class="card-body bb">
                            <div class="clearfix">
                                <div class="float-left">
                                    <a href="{{ route('helpdesk.index') }}"
                                       class="btn btn-danger btn-oval" type="button"
                                       title="Iniciar Atendimento">
                                        <em class="fas fa-arrow-left"></em>
                                        <span>Voltar</span>
                                    </a>
                                </div>
                                <div class="float-right">
                                    @if( $helpdesk->status_codigo == 1)
                                        <a href="{{ route('helpdesk.iniciar_chamado', $helpdesk->helpdesk_codigo) }}"
                                           class="btn btn-secondary btn-oval" type="button"
                                           title="Iniciar Atendimento">
                                            <em class="fa fa-play fa-fw text-muted"></em>
                                            <span>Iniciar Atendimento</span>
                                        </a>
                                    @elseif ( $helpdesk->status_codigo != 4 )
                                        <a href="{{ route('helpdesk.finalizar_chamado', $helpdesk->helpdesk_codigo) }}"
                                           class="btn btn-secondary btn-oval btn-finaliza-chamado" type="button"
                                           title="Finalizar Atendimento">
                                            <em class="fa fa-pause fa-stop text-muted"></em>
                                            <span>Finalizar Atendimento</span>
                                        </a>
                                    @elseif ( $helpdesk->status_codigo == 4 && $helpdesk->credencial_codigo_cliente == Auth::user()->credencial_codigo )
                                        <a href="{{ route('helpdesk.reabrir_chamado', $helpdesk->helpdesk_codigo) }}"
                                           class="btn btn-secondary btn-oval" type="button"
                                           title="Reabrir Atendimento">
                                            <em class="fa fa-pause fa-retweet"></em>
                                            <span>Reabrir Atendimento</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endcan

                <table class="table">
                    <tbody>
                    <tr>
                        <td>
                            <strong>Data de Abertura</strong>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($helpdesk->created_at)->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Categoria</strong>
                        </td>
                        <td>{{ $helpdesk->categoria->categoria_descricao }}</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Prioridade</strong>
                        </td>
                        <td>{{ $helpdesk->categoria->prioridade->prioridade_descricao }}</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Proprietário</strong>
                        </td>
                        <td>{{ $helpdesk->cliente->credencial_nome }}</td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Atendente</strong>
                        </td>
                        <td>
                            @if ( $helpdesk->credencial_codigo_atendente != null)
                                {{ $helpdesk->atendente->credencial_nome }}
                            @else
                                Aguardando por Atendimento
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- end Aside card-->
        </div>
    </div>
    <!-- FIM CARD CONTEÚDO -->
@endsection

@section('scripts')

    @include('helpdesk.script')

    <script>
        $(document).ready(function () {

            $('.btnPesquisa').click(function () {
                lista.do_buscar();
            });

            $('.btnPesquisa ').click();

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            /*
             *  Simple image gallery. Uses default settings
             */

            $('.fancybox').fancybox({
                helpers: {
                    overlay: {
                        overlayOpacity: 0.7
                    }
                }
            });

            $('.btn-finaliza-chamado').click(function (event) {
                event.preventDefault();
                let url = $(this).attr('href');

                $.confirm({
                    title: 'Desejas finalizar o chamado ?',
                    content: 'O mesmo poderá ser reaberto pelo usuário.',
                    buttons: {
                        cancel: {
                            text: 'Cancelar'
                        },
                        somethingElse: {
                            text: 'Confirmar',
                            btnClass: 'btn-blue',
                            keys: ['enter', 'shift'],
                            action: function () {
                                window.location.replace(url);
                            }
                        }
                    }
                });

            });


        });
    </script>
@endsection
