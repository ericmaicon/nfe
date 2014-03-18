<?php

//mostrando todos os error_get_last(oid)
ini_set('display_errors', 1);

//configuração de diretórios
$frameworkPath = __DIR__ . '/../lib';
$configFile = __DIR__ . '/conf/conf.ini';

//include da classe principal
require_once($frameworkPath . '/NFe.php');

//Iniciando a configuração da lib
NFe::configure($configFile);

//Consumindo
$consulta = new metodos\CadConsultaCadastro(
    array(
        'infCons' => array(
            'xServ' => 'CONS-CAD',
            'UF' => 'GO',
            'IE' => 'ISENTO',
        ),
    )
);
$consulta->UF = 'SP';
print_r($consulta->send());