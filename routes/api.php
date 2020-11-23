<?php

//USUÁRIOS
Route::get('users/list', 'api\UserController@list'); //CONSULTAR USUARIOS
Route::get('users/get/{id}', 'api\UserController@getUser'); //CONSULTAR USUARIO
Route::post('auth/login', 'api\AuthController@login'); //ROTA PARA FAZER LOGIN NO SISTEMA
Route::post('register', 'api\UserController@registerUser'); //ROTA PARA REGISTRO DE NOVOS USUARIOS
Route::patch('register/update/{id}', 'api\UserController@updateUser'); //ATUALIZA DADOS DO USUARIO
Route::delete('register/disable-user/{id}', 'api\UserController@disableUser'); //DESABILITAR USUARIO
Route::put('register/active-user/{id}', 'api\UserController@enableUser'); //ATIVAR USUARIO
Route::get('users/listdelete', 'api\UserController@softDelete'); //CONSULTAR USUARIO


// CADASTRO
Route::get('cliente/list', 'api\ClienteController@list'); //CONSULTAR USUARIO
Route::post('register/cliente', 'api\ClienteController@registerCliente'); //ROTA PARA REGISTRO DE NOVOS USUARIOS
Route::patch('update/cliente/{id}', 'api\ClienteController@updateCliente'); //ROTA PARA ATUALIZAÇÃO DE CLIENTE
Route::get('cliente/get/{id}', 'api\ClienteController@getCliente'); //CONSULTAR USUARIO

// Telefone
Route::get('telefone/get/{id}', 'api\TelefoneController@listTelefone'); //LISTAR TELEFONE
Route::post('telefone/add', 'api\TelefoneController@addTelefone'); //ADICIONAR TELEFONE
Route::delete('telefone/remove/{id}', 'api\TelefoneController@removeTelefone'); //ADICIONAR TELEFONE


/* ROTAS PROTEGIDAS POR AUTENTICAÇÃO */
Route::group(['middleware'=>['apiJwt']], function(){

});

