function auxfn_do_ajax(url, dataString, callback_ok, callback_fail){
	$.ajax({
		type: "GET",
		url: url,
		data: dataString,
		cache: false,
		dataType: 'json',
		timeout: 0,
		success: function(r){
			callback_ok(r);
		},
		error: function(r){
			if(callback_fail == null){
				auxfn_callback_fail_default(r)
			}else{
				callback_fail(r);
			}
		}
	});
}

function auxfn_callback_fail_default(r){
	console.error(r);
    iziToast.error({
        title: 'Error',
        message: 'Ocorreu uma falha na comunicação com o servidor.',
    });
}

function auxfn_showmessage(tipo, mensagem){
    if (tipo === 'sucesso'){
        iziToast.success({
            title: '',
            message: mensagem,
        });
    }else if (tipo == 'alerta') {
        iziToast.warning({
            title: '',
            message: mensagem,
        });
    }else if (tipo == 'erro') {
        iziToast.error({
            title: '',
            message: mensagem,
        });
    }
}
