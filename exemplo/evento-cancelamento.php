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
$cancelamento = new metodos\RecepcaoEvento(
    array(
        'infEvento' => array(
            'cOrgao' => '11',
            'tpAmb' => 2,
            'CNPJ' => '10643774000194',
            'chNFe' => '12334556712334556712334556712334556712334556',
            'dhEvento' => '2013-04-03T17:32:54-04:00',
            'tpEvento' => '110111',
            'nSeqEvento' => '20',
            'verEvento' => '1.00',
            'detEvento' => array(
                'descEvento' => 'Cancelamento',
                'nProt' => '111111111111111',
                'xJust' => 'Tipo de Justificativa',
            ),
        ),
    )
);
$cancelamento->UF = 'SP';
print_r($cancelamento->send());