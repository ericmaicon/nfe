<?php

//mostrando todos os erros
error_reporting(E_ALL);
ini_set('display_errors', 1);

//configuração de diretórios
$frameworkPath = __DIR__ . '/../lib';
$configFile = __DIR__ . '/conf/conf.ini';

//include da classe principal
require_once($frameworkPath . '/NFe.php');

//Iniciando a configuração da lib
NFe::configure($configFile);

//Criando o model
$consultaCadastroModel = new parametros\NFeConsultaCadastroModel();
$consultaCadastroModel->xServ = "CONS-CAD";
$consultaCadastroModel->UF = "GO";
$consultaCadastroModel->IE = "";

//Consumindo
$consultaCadastro = new metodos\NFeConsultaCadastro($consultaCadastroModel);
$consultaCadastro->sign();
// $consultaCadastro->validate();
// $consultaCadastro->send();