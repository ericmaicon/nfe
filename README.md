Nota Fiscal Eletrônica
===
Projeto em PHP que pretende contemplar:

* Criação do arquivo XML;
* Assinatura;
* Validação com o XSD;
* Envio.

## Métodos atendidos:

* [Emissão ou Recepção de NFe (NfeRecepcao)](#emiss%C3%A3o-de-notas-fiscais)
* [Consulta de processamento da NFe (NfeRetRecepcao)](#consulta-de-processamento)
* [Consulta da NFe (NfeConsultaProtocolo)](#consulta-de-nfe)
* [Inutilização (NfeInutilizacao)](#inutiliza%C3%A7%C3%A3o)
* [Eventos de Cancelamento NFe (RecepcaoEvento)](#evento-de-cancelamento)
* [Consulta de cadastro (NfeConsultaCadastro)](#consulta-de-cadastro)

## Conceito da NFe:

A NFe é uma forma criada pela receita federal para facilitar a emissão de notas fiscais. Grosseiramente, para que um software emite uma nota, ele deve acessar o webservice do SEFAZ do *ESTADO DO VENDEDOR* e enviar os dados. Se tudo estiver correto, ele receberá um OK.

Para que a NFe passe pela validação, além de todos os dados necessários, há algumas regras que devem ser respeitadas:

* O CNPJ do vendedor não pode ter nenhum problema;
* O CPF ou CNPJ do comprador não pode ter nenhum problema;
* A nota deve ser assinada digitalmente.

Se validado, após a emissão, o Web Service do SEFAZ irá retornar um documento contendo o protocolo de aceitação e a autorização para impressão da nota. Com isso, pode ser feito a impressão do DANFE, que é a representação da nota fiscal em papel A4 comum.

## Funcionamento:

### Uso geral:

Para iniciar o uso dessa biblioteca, é preciso fazer o import:

```php
$frameworkPath = __DIR__ . '/../lib';
require_once($frameworkPath . '/NFe.php');
```

Existe um arquivo de configuração que contém o caminho da chave (Arquivo com extensão .PEM) e as URLS de todos os estados e métodos WebService. Você pode ver esse [arquivo na pasta](https://github.com/ericmaicon/nfe/blob/master/exemplo/conf/conf.ini). Para utilizar a biblioteca, é preciso passar esse arquivo como parâmetro de configuração:

```php
$configFile = __DIR__ . '/conf/conf.ini';
NFe::configure($configFile);
```

A biblioteca tem métodos em comum para todos os consumos:

*Retornar o XML:*
```php
$consumo = metodos\NfeInutilizacao(
    array(
        ...
    )
);
$consumo->UF = "GO";
$consumo->getXml();
```

*Retornar um XML de Exemplo:*
```php
$consumo = metodos\NfeInutilizacao(
    array(
        ...
    )
);
$consumo->UF = "GO";
$consumo->getXmlExample();
```

*Retornar um XML dentro do Envelope:*
```php
$consumo = metodos\NfeInutilizacao(
    array(
        ...
    )
);
$consumo->UF = "GO";
$xml = $consumo->getXml();
$consumo->envelop($xml);
```

*Retornar um xml assinado:*
```php
$consumo = metodos\NfeInutilizacao(
    array(
        ...
    )
);
$consumo->UF = "GO";
$xml = $consumo->getXml();
$consumo->sign($xml);
```

*Validar um XML:*
```php
$consumo = metodos\NfeInutilizacao(
    array(
        ...
    )
);
$consumo->UF = "GO";
$xml = $consumo->getXml();
$consumo->validate($xml);
```

*Enviar para o SEFAZ:*
```php
$consumo = metodos\NfeInutilizacao(
    array(
        ...
    )
);
$consumo->UF = "GO";
$consumo->send();
```

## Métodos

### Emissão de Notas fiscais:

Para emitir uma nota fiscal, levando em consideração que todos os dados já estão corretos, basta chamar o serviço, passando um array com os parâmetros:
```php
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
                    'CNPJ' => '',
                    'xNome' => '',
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
                    'CNPJ' => '',
                    'xNome' => '',
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
                'det' => array(
                    'nItem' => 1,
                    'prod' => array(
                        'cProd' => 'CFOP9999',
                        'cEAN' => '',
                        'xProd' => 'Algum Produto',
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
```

É obrigatório informar o estado de emissão, para identificar a URL de envio: 
```php
$recepcao->UF = 'SP';
```

Para enviar:
```php
$recepcao->send();
```

## Consulta de Processamento:
```php
$consulta = new metodos\NfeRetRecepcao(
    array(
        'tpAmb' => '2',
        'nRec' => '351000078534858',
    )
);
$consulta->UF = 'SP';
$consulta->send();
```

## Consulta de NFe:
```php
$consulta = new metodos\NFeConsulta(
    array(
        'tpAmb' => '2',
        'xServ' => 'CONSULTAR',
        'chNFe' => '12334556712334556712334556712334556712334556',
    )
);
$consulta->UF = 'SP';
$consulta->send();
```

## Inutilização:
```php
$inutiliza = new metodos\NfeInutilizacao(
    array(
        'infInut' => array(
            'tpAmb' => '2',
            'xServ' => 'INUTILIZAR',
            'cUF' => 35,
            'ano' => 14,
            'CNPJ' => '',
            'mod' => '55',
            'serie' => '12',
            'nNFIni' => '100000001',
            'nNFFin' => '100000002',
            'xJust' => 'Tipo Justificativa',
        ),
    )
);
$inutiliza->UF = 'SP';
$inutiliza->send();
```

## Evento de Cancelamento:
```php
$cancelamento = new metodos\RecepcaoEvento(
    array(
        'infEvento' => array(
            'cOrgao' => '11',
            'tpAmb' => 2,
            'CNPJ' => '',
            'chNFe' => '',
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
$cancelamento->send();
```

## Consulta de Cadastro:
```php
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
$consulta->send();
```

# Configurações Extras:

*Definir versão do XML:*
```php
$consumo = metodos\NfeInutilizacao();
$consumo->versao = "3.01";
```

*Definir XSD de validação do XML:*
```php
$consumo = metodos\NfeInutilizacao();
$consumo->xsd = "inutNFe_v2.00.xsd";
```

*TAG para assinatura:*

Quando for utilizar o método sign, pode ser informado a TAG de assinatura:
```php
$this->sign($xml, 'infInut');
```

*Envio*

Você não precisa usar esta biblioteca para gerar o XML. Pode usá-la para assinar um XML existente, ou envelopar, ou ainda só enviar. Veja o cabeçalho do método sign:

```php
public function send($xml = null, $envelop = true, $sign = true, $returnXml = false) {
    ...
}
```

*Retorno*

Você ainda pode escolher como quer ver o retorno. O padrão é um Array, mas pode retornar o XML de retorno do SEFAZ.

## Procura por algo a mais?

### Convertendo o certificado PFX para PEM

    openssl pkcs12 -in certificado.pfx -out certificado.pem -nodes

### Manual utilizado:

http://www.nfe.fazenda.gov.br/portal/exibirArquivo.aspx?conteudo=zxlLdxB/oYA=

### Lista de URLs de Homologação:

http://hom.nfe.fazenda.gov.br/portal/webServices.aspx

### Pacote de XSD:

http://www.nfe.fazenda.gov.br/portal/listaConteudo.aspx?tipoConteudo=/fwLvLUSmU8=

### Validador de XML:

https://www.sefaz.rs.gov.br/nfe/NFE-VAL.aspx

### Código de municípios:

http://www.ibge.gov.br/home/geociencias/areaterritorial/area.shtm

### Mais informações:

http://jornalggn.com.br/blog/luisnassif/o-funcionamento-da-nota-fiscal-eletronica

https://nfe.mps.com.br/Portal/Nfe.aspx

http://www.rt1.com.br/drupal/?q=content/como-funciona-nota-fiscal-eletr%C3%B4nica-nfe

http://www.akadia.com/services/ssh_test_certificate.html

http://www.linhadecodigo.com.br/artigo/1695/iniciando-um-projeto-de-nota-fiscal-eletronica-nfe.aspx

### Créditos

**Eric Maicon** <eric at ericmaicon dot com dot br>

**Roberto L. Machado** <linux.rlm at gmail dot com> (Mesmo que ele nem saiba desse projeto, toda a função de assinatura foi copiada do código que ele fez [aqui](https://www.assembla.com/code/nfephp/subversion/nodes/658/branches/2.0/libs/ToolsNFePHP.class.php)).
