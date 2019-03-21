<?php

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'checkPermission']], function () {
    Route::get('/home',              'HomeController@index')->name('dashboard.index');
    Route::resource('categorias',    'CategoriasController');
    Route::resource('helpdesk',      'HelpdeskController');
    Route::resource('empresas',      'EmpresasController');
    Route::resource('departamentos',  'DepartamentosController');
    Route::resource('fabricante',    'HelpdeskController');
    Route::resource('perfilacesso',    'PerfisController');

    /* -------------------- HELPDESK -------------------- */
    Route::get('helpdesk/iniciarAtendimento/{id}', 'HelpdeskController@iniciarAtendimento')->name('helpdesk.iniciar_chamado');
    Route::get('helpdesk/finalizarAtendimento/{id}', 'HelpdeskController@finalizarAtendimento')->name('helpdesk.finalizar_chamado');
    Route::get('helpdesk/reabrirAtendimento/{id}', 'HelpdeskController@reabrirAtendimento')->name('helpdesk.reabrir_chamado');
    Route::post('helpdesk/inserirInteracao', 'HelpdeskController@inserirInteracao')->name('helpdesk.inserir_interacao');
});
