<script>
var lista = {
	do_alimenta_tabela: function(resposta){
		let html = '';
		
		if (resposta.data.length > 0) {
				for (let i = 0; i < resposta.data.length; i++) {
					html += '<tr>';
					html += '<td>' + resposta.data[i].categoria_codigo + '</td>';
					html += '<td>' + resposta.data[i].categoria_descricao + '</td>';
					html += '<td>' + resposta.data[i].prioridade_descricao + '</td>';
					html += '</tr>';
				}
			}else{
				html += '<tr>';
				html += '<td colspan="3">Nenhum registro a exibir</td>';
				html += '</tr>';
			}
			
			$('.tabela_categorias tbody').html(html);
			$('.cardConteudo').fadeIn();
	}
}

</script>