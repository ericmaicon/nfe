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
$recepcaoRequest = new request\NFeRecepcaoRequest();
$recepcaoRequest->xServ = "CONS-CAD";

//Criando o model de response
$recepcaoResponse = new response\NFeRecepcaoResponse();

//Consumindo
$recepcao = new metodos\NFeRecepcao($recepcaoRequest);
$recepcao->send($recepcaoResponse);
print_r($recepcaoResponse);