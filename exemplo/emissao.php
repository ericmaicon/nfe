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
                'ide' => array(
                    'cUF' => 35,
                    'cNF' => $cNF,
                    'natOp' => 'venda',
                    'indPag' => 1,
                    'mod' => 55,
                    'serie' => "0",
                    'nNF' => "123456789",
                    'dEmi' => '2014-02-26',
                    'tpNF' => 1,
                    'cMunFG' => 3550308,
                    'tpImp' => 1,
                    'tpEmis' => 1,
                    'cDV' => '',
                    'tpAmb' => 2,
                    'finNFe' => 1,
                    'procEmi' => 0,
                    'verProc' => 'v1.0',
                ),
                'emit' => array(
                    'CNPJ' => '10643774000194',
                    'xNome' => 'Fernando Emanual Carneiro',
                    'enderEmit' => array(
                        'xLgr' => 'RUA PRUDENTE DE MORAES',
                        'nro' => "100",
                        'xBairro' => 'CENTRAL',
                        'cMun' => 3553708,
                        'xMun' => 'Goiania',
                        'UF' => 'SP',
                        'CEP' => 74350000,
                    ),
                    'IE' => 'ISENTO',
                    'CRT' => 3,
                ),
                'dest' => array(
                    'CNPJ' => '13755364000123',
                    'xNome' => 'Fernando Emanual Carneiro',
                    'enderDest' => array(
                        'xLgr' => 'RUA ENG FUAD RASSI',
                        'nro' => "100",
                        'xBairro' => 'VILA JARAGUA',
                        'cMun' => 3553708,
                        'xMun' => 'Goiania',
                        'UF' => 'SP',
                        'CEP' => 74350000,
                    ),
                    'IE' => 'ISENTO',
                ),
                'det1' => array(
                    'prod' => array(
                        'cProd' => 'CFOP9999',
                        'cEAN' => '',
                        'xProd' => 'Bateria Eletronica',
                        'NCM' => '00',
                        'CFOP' => 5102,
                        'uCom' => 1,
                        'qCom' => 1,
                        'vUnCom' => 100.00,
                        'vProd' => 100.00,
                        'cEANTrib' => '',
                        'uTrib' => 1,
                        'qTrib' => 1,
                        'vUnTrib' => 100.00,
                        'indTot' => 0,
                    ),
                    'imposto' => array(
                        'ICMS' => array(
                            'ICMS00' => array(
                                'orig' => 0,
                                'CST' => "00",
                                'modBC' => 0,
                                'vBC' => 0,
                                'pICMS' => 0,
                                'vICMS' => 0,
                            ),
                        ),
                        'IPI' => array(
                            'clEnq' => 1,
                            'cSelo' => 1,
                            'qSelo' => 1,
                            'cEnq' => 1,
                            'IPINT' => array(
                                'CST' => "02",
                            ),
                        ),
                        'PIS' => array(
                            'PISAliq' => array(
                                'CST' => '01',
                                'vBC' => 0,
                                'pPIS' => 0,
                                'vPIS' => 0,
                            ),
                        ),
                        'COFINS' => array(
                            'COFINSAliq' => array(
                                'CST' => '01',
                                'vBC' => 0,
                                'pCOFINS' => 0,
                                'vCOFINS' => 0,
                            ),
                        ),
                    ),
                ),
                'det2' => array(
                    'prod' => array(
                        'cProd' => 'CFOP9999',
                        'cEAN' => '',
                        'xProd' => 'Bateria Eletronica',
                        'NCM' => '00',
                        'CFOP' => 5102,
                        'uCom' => 1,
                        'qCom' => 1,
                        'vUnCom' => 100.00,
                        'vProd' => 100.00,
                        'cEANTrib' => '',
                        'uTrib' => 1,
                        'qTrib' => 1,
                        'vUnTrib' => 100.00,
                        'indTot' => 0,
                    ),
                    'imposto' => array(
                        'ICMS' => array(
                            'ICMS00' => array(
                                'orig' => 0,
                                'CST' => "00",
                                'modBC' => 0,
                                'vBC' => 0,
                                'pICMS' => 0,
                                'vICMS' => 0,
                            ),
                        ),
                        'IPI' => array(
                            'clEnq' => 1,
                            'cSelo' => 1,
                            'qSelo' => 1,
                            'cEnq' => 1,
                            'IPINT' => array(
                                'CST' => "02",
                            ),
                        ),
                        'PIS' => array(
                            'PISAliq' => array(
                                'CST' => '01',
                                'vBC' => 0,
                                'pPIS' => 0,
                                'vPIS' => 0,
                            ),
                        ),
                        'COFINS' => array(
                            'COFINSAliq' => array(
                                'CST' => '01',
                                'vBC' => 0,
                                'pCOFINS' => 0,
                                'vCOFINS' => 0,
                            ),
                        ),
                    ),
                ),
                'total' => array(
                    'ICMSTot' => array(
                        'vBC' => 0,
                        'vICMS' => 0,
                        'vBCST' => 0,
                        'vST' => 0,
                        'vProd' => 100.00,
                        'vFrete' => 0,
                        'vSeg' => 0,
                        'vDesc' => 0,
                        'vII' => 0,
                        'vIPI' => 0,
                        'vPIS' => 0,
                        'vCOFINS' => 0,
                        'vOutro' => 0,
                        'vNF' => 100.00,
                    ),
                ),
                'transp' => array(
                    'modFrete' => 9,
                ),
            ),
        ),
    )
);
$recepcao->UF = 'SP';
print_r($recepcao->send());