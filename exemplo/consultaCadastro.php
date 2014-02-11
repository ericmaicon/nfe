<?php

//mostrando todos os erros
ini_set('display_errors', 1);

//configuração de diretórios
$frameworkPath = __DIR__ . '/../lib';
$configFile = __DIR__ . '/conf/conf.ini';

//include da classe principal
require_once($frameworkPath . '/NFe.php');

//Iniciando a configuração da lib
NFe::configure($configFile);

//Criando o model de request
$consultaCadastroRequest = new request\NFeConsultaCadastroRequest();
$consultaCadastroRequest->xServ = "CONS-CAD";
$consultaCadastroRequest->UF = "SP";
$consultaCadastroRequest->IE = "ISENTO";

//Criando o model de response
$consultaCadastroResponse = new response\NFeConsultaCadastroResponse();

//Consumindo
$consultaCadastro = new metodos\NFeConsultaCadastro($consultaCadastroRequest);
$consultaCadastro->send($consultaCadastroResponse);
print_r($consultaCadastroResponse);