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

//Consumindo
$consultaCadastro = new metodos\NFeConsultaCadastro(
    array(
        'xServ' => 'CONS-CAD',
        'UF' => 'SP',
        'IE' => 'ISENTO',
    )
);
print_r($consultaCadastro->send());