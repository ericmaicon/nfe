<?php

$frameworkPath = __DIR__ . '/../../nfe';
require($frameworkPath . '/Nfe.php');

$nota = new nfe\envio\Document();
$nota->withCabecalho()
        ->setEnvNFe(array(
            'versao' => '1.01',
            'idLote' => '200602220000001',
            'NFe' => array(
                'infNFe' => array(
                    'Id' => 'NFe31060243816719000108550000000010001234567890',
                    'versao' => '1.01',
                    'ide' => array(
                        'cUF' => '',
                        'cNF' => '',
                        'natOp' => '',
                        'indPag' => '',
                        'mod' => '',
                        'serie' => '',
                        'nNF' => '',
                        'dEmi' => '',
                        'dSaiEnt' => '',
                        'hSaiEnt' => '',
                        'tpNF' => '',
                        'cMunFG' => '',
                        'tpImp' => '',
                        'tpEmis' => '',
                        'cDV' => '',
                        'tpAmb' => '2',
                        'finNFe' => '1',
                        'procEmi' => '0',
                        'verProc' => '',
                    ),
                    'emit' => array(
                        'CNPJ' => '',
                        'xNome' => '',
                        'enderEmit>' => array(),
                    ),
                ),
            ),
        ))
        ->build();

echo $nota->toXml();