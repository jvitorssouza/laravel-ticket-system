<script>
var lista = {

    do_buscar: function(pagina = null){

        $('.cardConteudo').toggleClass('whirl');

        let params = '_token={{ csrf_token() }}';

        if ($('#filtroDescricao').val() != '') {
            params += '&filtroDescricao=' + $('#filtroDescricao').val();
        }

        if ($('#filtroEmpresa').val() != '._.') {
            params += '&filtroPrioridade=' + $('#filtroPrioridade').val();
        }

        if (pagina != null){
            params += '&page='+pagina;
        }

        auxfn_do_ajax("{{route('departamentos.index')}}", params, lista.do_alimenta_tabela, null);
    },

	do_alimenta_tabela: function(resposta){

			$('.tabela_categorias tbody').html(resposta.dados);

            lista.do_gerencia_paginacao(resposta.links);

            $('.cardConteudo').toggleClass('whirl');

        $('.btn-delete').click(function (event) {
            event.preventDefault();
            let form = $(this).parent('form');

            $.confirm({
                title: 'Desejas deletar este registro ?',
                content: 'Esta ação não poderá ser desfeita.',
                buttons: {
                    cancel: {
                        text: 'Cancelar'
                    },
                    somethingElse: {
                        text: 'Confirmar',
                        btnClass: 'btn-blue',
                        keys: ['enter', 'shift'],
                        action: function(){
                            form.submit();
                        }
                    }
                }
            });

        });
	},

    do_gerencia_paginacao: function (links) {
        if (typeof links != 'undefined'){
            let html = '<nav>';

            html += '<ul class="pagination">';
            html += '<li class="page-item prev" pagina="">';
                html += '<a class="page-link" aria-label="Previous"><span aria-hidden="true">&laquo;</span> <span class="sr-only">Previous</span></a>';
            html += '</li>';

            for (let i = 0; i < parseInt(links.last_page); i++){
                html += '<li class="page-item" pagina="'+ (i+1) +'"><a class="page-link">'+ (i+1) +'</a></li>';
            }

            html += '<li class="page-item next" pagina="">';
                html += '<a class="page-link" aria-label="Next"><span aria-hidden="true">&raquo;</span> <span class="sr-only">Next</span></a>';
            html += '</li>';
            html += '</ul>';

            $('.links').html(html);
            $('.page-item[pagina="'+links.current_page+'"]').addClass('active');

            $('.prev').attr('pagina', Number(links.current_page) - 1);
            $('.next').attr('pagina', Number(links.current_page) + 1);

            if (links.prev_page_url === null){
                $('.prev').attr('pagina', links.last_page);
            }

            if (links.current_page === links.last_page){
                $('.next').attr('pagina', 0);
            }

            $('.page-item').click(function () {
                lista.do_buscar($(this).attr('pagina'));
            });

        }
    }
}



</script>
