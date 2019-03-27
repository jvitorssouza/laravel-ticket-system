<!-- =============== VENDOR SCRIPTS ===============-->
<!-- JQUERY-->
<script src="{{ asset('vendor/jquery/dist/jquery.js') }}"></script>
<!-- BOOTSTRAP-->
<script src="{{ asset('vendor/popper.js/dist/popper.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
<!-- STORAGE API-->
<script src="{{ asset('vendor/js-storage/js.storage.js') }}"></script>
<!-- SCREENFULL-->
<script src="{{ asset('vendor/screenfull/dist/screenfull.js') }}"></script>
<!-- =============== PAGE VENDOR SCRIPTS ===============-->
<!-- SLIMSCROLL-->
<script src="{{ asset('vendor/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<!-- MOMENT JS-->
<script src="{{ asset('vendor/moment/min/moment-with-locales.js') }}"></script>

<script>
    moment.locale("pt-br");
</script>

<!-- CONFIRM -->
<script src="{{ asset('vendor/jquery-confirm/jquery-confirm.min.js') }}"></script>
<!-- =============== APP SCRIPTS ===============-->
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.js') }}"></script>
<script src="{{ asset('assets/js/fancybox.js?v=2.1.5') }}"></script>
<script src="{{ asset('assets/js/jquery.mask.js') }}"></script>

<script src="{{ asset('assets/js/funcoesAux.js') }}"></script>
<script src="{{ asset('assets/js/jquery.multi-select.js') }}"></script>

@if(session()->has('message'))
    <script>
        iziToast.success({
            title: '',
            message: '{{ session()->get('message') }}',
        });
    </script>
@endif

@if(session()->has('error'))
    <script>
        iziToast.error({
            title: '',
            message: '{{ session()->get('message') }}',
        });
    </script>
@endif

<script src="{{ asset('assets/js/Chart.js') }}"></script>

<script>
    var home = {
        do_buscar_graficos : function () {
            let params = '';
            auxfn_do_ajax("{{route('dashboard.getGraficos')}}", params, home.do_buscar_graficos_ok, null);
        },
        
        do_buscar_graficos_ok: function (resposta) {
            // console.log(resposta);
            var myDoughnutChart = new Chart($('#grafico_chamado_aberto_chamado_fechado_mes').get(), {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: resposta.abertos_fechados_mes.values,
                        backgroundColor: resposta.abertos_fechados_mes.colors
                    }],

                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: resposta.abertos_fechados_mes.labels
                }
            });

            var myBarChartDepartamentos = new Chart($('#grafico_chamado_aberto_departamentos_mes').get(), {
                type: 'bar',
                data: {
                    datasets: resposta.abertos_departamentos_mes.datasets,
                },

            });

            var myBarChartEmpresas = new Chart($('#grafico_chamado_aberto_empresas_mes').get(), {
                type: 'bar',
                data: {
                    datasets: resposta.abertos_empresas_mes.datasets,
                },

            });
        }
    };
</script>

@yield('scripts')
