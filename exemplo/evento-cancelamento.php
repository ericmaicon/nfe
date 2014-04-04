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
            'chNFe' => '35140310643774000194550006800000001799884032',
            'dhEvento' => '2014-03-28T14:23:54-04:00',
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