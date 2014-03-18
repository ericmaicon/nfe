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
$inutiliza = new metodos\NfeInutilizacao(
    array(
        'infInut' => array(
            'tpAmb' => '2',
            'xServ' => 'INUTILIZAR',
            'cUF' => 35,
            'ano' => 14,
            'CNPJ' => '10643774000194',
            'mod' => '55',
            'serie' => '12',
            'nNFIni' => '100000001',
            'nNFFin' => '100000002',
            'xJust' => 'Tipo Justificativa',
        ),
    )
);
$inutiliza->UF = 'SP';
print_r($inutiliza->send());