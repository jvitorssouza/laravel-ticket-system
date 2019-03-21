<script>
var lista = {

    do_buscar: function(pagina = null){

        $('.cardConteudo').toggleClass('whirl');

        let params = '_token={{ csrf_token() }}';

        if ($('#filtroCpfCnpj').val() != '') {
            params += '&filtroCpfCnpj=' + $('#filtroCpfCnpj').val();
        }

        if ($('#filtroRzSocialFantasia').val() != '') {
            params += '&filtroRzSocialFantasia=' + $('#filtroRzSocialFantasia').val();
        }

        if (pagina != null){
            params += '&page='+pagina;
        }

        auxfn_do_ajax("{{route('empresas.index')}}", params, lista.do_alimenta_tabela, null);
    },

	do_alimenta_tabela: function(resposta){

			$('.tabela_empresas tbody').html(resposta.dados);

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

function limpa_formulário_cep() {
    // Limpa valores do formulário de cep.
    $("#empresa_logradouro  ").val("");
    $("#empresa_bairro").val("");
    $("#empresa_cidade").val("");
    $("#empresa_uf").val("");
}

$("#empresa_cep").blur(function() {

    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#empresa_logradouro  ").val("...");
            $("#empresa_bairro").val("...");
            $("#empresa_cidade").val("...");
            $("#empresa_uf").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#empresa_logradouro").val(dados.logradouro);
                    $("#empresa_bairro").val(dados.bairro);
                    $("#empresa_cidade").val(dados.localidade);
                    $("#empresa_uf").val(dados.uf);
                }else {
                    limpa_formulário_cep();
                    auxfn_showmessage('alerta', 'CEP não encontrado.');
                }
            });
        } else {
            limpa_formulário_cep();
            auxfn_showmessage('alerta', 'Formato do CEP inválido.');
        }
    } else {
        limpa_formulário_cep();
    }
});

$("#empresa_cep").keyup(function() {
    this.value = this.value.replace(/[^\d]/,'');
});

</script>
