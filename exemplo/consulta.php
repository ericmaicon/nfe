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
$consulta = new metodos\NFeConsulta(
    array(
        'tpAmb' => '2',
        'xServ' => 'CONSULTAR',
        'chNFe' => '12334556712334556712334556712334556712334556',
    )
);
$consulta->UF = 'SP';
print_r($consulta->send());