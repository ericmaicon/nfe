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

$cNF = rand(10000000,99999999);

//Consumindo
$recepcao = new metodos\NFeRecepcao(
    array(
        'idLote' => '000000000000001',
        'NFe' => array(
            'infNFe' => array(
                'Id' => metodos\NFeRecepcao::calcularId('GO', '2014-02-25', '66568162000139', '55', '000', '1', '1', $cNF),
                'ide' => array(
                    'cUF' => '11',
                    'cNF' => $cNF,
                    'natOp' => '',
                    'indPag' => '0',
                    'mod' => '55',
                    'serie' => '',
                    'nNF' => '',
                    'dEmi' => '',
                    'tpNF' => '0',
                    'cMunFG' => '',
                    'tpImp' => '1',
                    'tpEmis' => '1',
                    'cDV' => '',
                    'tpAmb' => '2',
                    'finNFe' => '1',
                    'procEmi' => '0',
                    'verProc' => '',
                ),
                'emit' => array(
                    'CNPJ' => '66568162000139',
                    'xNome' => '',
                    'enderEmit' => array(
                        'xLgr' => '',
                        'nro' => '',
                        'xBairro' => '',
                        'cMun' => '',
                        'xMun' => '',
                        'UF' => '',
                        'CEP' => '',
                    ),
                    'IE' => '',
                    'CRT' => '',
                ),
                'dest' => array(
                    'CNPJ' => '',
                    'xNome' => '',
                    'enderDest' => array(
                        'xLgr' => '',
                        'nro' => '',
                        'xBairro' => '',
                        'cMun' => '',
                        'xMun' => '',
                        'UF' => '',
                        'CEP' => '',
                    ),
                    'IE' => '',
                ),
                'det' => array(
                    'nItem' => '',
                    'prod' => array(
                        'cProd' => '',
                        'cEAN' => '',
                        'xProd' => '',
                        'NCM' => '',
                        'CFOP' => '',
                        'uCom' => '',
                        'qCom' => '',
                        'vUnCom' => '',
                        'vProd' => '',
                        'cEANTrib' => '',
                        'uTrib' => '',
                        'qTrib' => '',
                        'vUnTrib' => '',
                        'indTot' => '',
                    ),
                    'imposto' => array(
                        'PIS' => array(
                            'PISAliq' => array(
                                'CST' => '',
                                'vBC' => '',
                                'pPIS' => '',
                                'vPIS' => '',
                            ),
                        ),
                        'COFINS' => array(
                            'COFINSAliq' => array(
                                'CST' => '',
                                'vBC' => '',
                                'pCOFINS' => '',
                                'vCOFINS' => '',
                            ),
                        ),
                    ),
                ),
                'total' => array(
                    'ICMSTot' => array(
                        'vBC' => '',
                        'vICMS' => '',
                        'vBCST' => '',
                        'vST' => '',
                        'vProd' => '',
                        'vFrete' => '',
                        'vSeg' => '',
                        'vDesc' => '',
                        'vII' => '',
                        'vIPI' => '',
                        'vPIS' => '',
                        'vCOFINS' => '',
                        'vOutro' => '',
                        'vNF' => '',
                    ),
                ),
                'transp' => array(
                    'modFrete' => '',
                ),
            ),
        ),
    )
);
print_r($recepcao->send());