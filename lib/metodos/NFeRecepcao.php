<?php

namespace metodos;

/**
 * Histórico de alterações:
 * {dd/mm/yyyy} {autor} {descrição}
 * 
 **/

/**
 * Classe que consome o webservice NFeRecepcao
 * 
 * @class NFeRecepcao
 * @version <1.0.0>
 * @date 10/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class NFeRecepcao extends \metodos\NFeMetodo {

    /**
     * Sobreescrita do construtor para setar as variáveis
     * 
     * @param $request
     * @author Eric Maicon
     */
    public function __construct($request = null) {
        $this->versao = '2.00';
        $this->xsd = 'enviNFe_v2.00.xsd';
        $this->servico = 'NfeRecepcao2';

        parent::__construct($request);
    }

    /**
     * Método que retorna o XML Pronto
     * 
     * @author Eric Maicon
     */
    public function getXml() {
        $this->xml = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<enviNFe versao="{$this->versao}" xmlns="http://www.portalfiscal.inf.br/nfe"
    xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.portalfiscal.inf.br/nfe {$this->xsd} ">
    <idLote>{$this->request['idLote']}</idLote>
    <NFe>
        <infNFe Id="{$this->request['NFe']['infNFe']['Id']}" versao="{$this->versao}">
            <ide>
                <cUF>{$this->request['NFe']['infNFe']['ide']['cUF']}</cUF>
                <cNF>{$this->request['NFe']['infNFe']['ide']['cNF']}</cNF>
                <natOp>{$this->request['NFe']['infNFe']['ide']['natOp']}</natOp>
                <indPag>{$this->request['NFe']['infNFe']['ide']['indPag']}</indPag>
                <mod>{$this->request['NFe']['infNFe']['ide']['mod']}</mod>
                <serie>{$this->request['NFe']['infNFe']['ide']['serie']}</serie>
                <nNF>{$this->request['NFe']['infNFe']['ide']['nNF']}</nNF>
                <dEmi>{$this->request['NFe']['infNFe']['ide']['dEmi']}</dEmi>
                <tpNF>{$this->request['NFe']['infNFe']['ide']['tpNF']}</tpNF>
                <cMunFG>{$this->request['NFe']['infNFe']['ide']['cMunFG']}</cMunFG>
                <tpImp>{$this->request['NFe']['infNFe']['ide']['tpImp']}</tpImp>
                <tpEmis>{$this->request['NFe']['infNFe']['ide']['tpEmis']}</tpEmis>
                <cDV>{$this->request['NFe']['infNFe']['ide']['cDV']}</cDV>
                <tpAmb>{$this->request['NFe']['infNFe']['ide']['tpAmb']}</tpAmb>
                <finNFe>{$this->request['NFe']['infNFe']['ide']['finNFe']}</finNFe>
                <procEmi>{$this->request['NFe']['infNFe']['ide']['procEmi']}</procEmi>
                <verProc>{$this->request['NFe']['infNFe']['ide']['verProc']}</verProc>
            </ide>
            <emit>
                <CNPJ>{$this->request['NFe']['infNFe']['emit']['CNPJ']}</CNPJ>
                <xNome>{$this->request['NFe']['infNFe']['emit']['xNome']}</xNome>
                <enderEmit>
                    <xLgr>{$this->request['NFe']['infNFe']['emit']['enderEmit']['xLgr']}</xLgr>
                    <nro>{$this->request['NFe']['infNFe']['emit']['enderEmit']['nro']}</nro>
                    <xBairro>{$this->request['NFe']['infNFe']['emit']['enderEmit']['xBairro']}</xBairro>
                    <cMun>{$this->request['NFe']['infNFe']['emit']['enderEmit']['cMun']}</cMun>
                    <xMun>{$this->request['NFe']['infNFe']['emit']['enderEmit']['xMun']}</xMun>
                    <UF>{$this->request['NFe']['infNFe']['emit']['enderEmit']['UF']}</UF>
                    <CEP>{$this->request['NFe']['infNFe']['emit']['enderEmit']['CEP']}</CEP>
                </enderEmit>
                <IE>{$this->request['NFe']['infNFe']['emit']['IE']}</IE>
                <CRT>{$this->request['NFe']['infNFe']['emit']['CRT']}</CRT>
            </emit>
            <dest>
                <CNPJ>{$this->request['NFe']['infNFe']['dest']['CNPJ']}</CNPJ>
                <xNome>{$this->request['NFe']['infNFe']['dest']['xNome']}</xNome>
                <enderDest>
                    <xLgr>{$this->request['NFe']['infNFe']['dest']['enderDest']['xLgr']}</xLgr>
                    <nro>{$this->request['NFe']['infNFe']['dest']['enderDest']['nro']}</nro>
                    <xBairro>{$this->request['NFe']['infNFe']['dest']['enderDest']['xBairro']}</xBairro>
                    <cMun>{$this->request['NFe']['infNFe']['dest']['enderDest']['cMun']}</cMun>
                    <xMun>{$this->request['NFe']['infNFe']['dest']['enderDest']['xMun']}</xMun>
                    <UF>{$this->request['NFe']['infNFe']['dest']['enderDest']['UF']}</UF>
                </enderDest>
                <IE>{$this->request['NFe']['infNFe']['dest']['IE']}</IE>
            </dest>
            <det nItem="{$this->request['NFe']['infNFe']['det']['nItem']}">
                <prod>
                    <cProd>{$this->request['NFe']['infNFe']['det']['prod']['cProd']}</cProd>
                    <cEAN>{$this->request['NFe']['infNFe']['det']['prod']['cEAN']}</cEAN>
                    <xProd>{$this->request['NFe']['infNFe']['det']['prod']['xProd']}</xProd>
                    <NCM>{$this->request['NFe']['infNFe']['det']['prod']['NCM']}</NCM>
                    <CFOP>{$this->request['NFe']['infNFe']['det']['prod']['CFOP']}</CFOP>
                    <uCom>{$this->request['NFe']['infNFe']['det']['prod']['uCom']}</uCom>
                    <qCom>{$this->request['NFe']['infNFe']['det']['prod']['qCom']}</qCom>
                    <vUnCom>{$this->request['NFe']['infNFe']['det']['prod']['vUnCom']}</vUnCom>
                    <vProd>{$this->request['NFe']['infNFe']['det']['prod']['vProd']}</vProd>
                    <cEANTrib>{$this->request['NFe']['infNFe']['det']['prod']['cEANTrib']}</cEANTrib>
                    <uTrib>{$this->request['NFe']['infNFe']['det']['prod']['uTrib']}</uTrib>
                    <qTrib>{$this->request['NFe']['infNFe']['det']['prod']['qTrib']}</qTrib>
                    <vUnTrib>{$this->request['NFe']['infNFe']['det']['prod']['vUnTrib']}</vUnTrib>
                    <indTot>{$this->request['NFe']['infNFe']['det']['prod']['indTot']}</indTot>
                </prod>
                <imposto>
                    <PIS>
                        <PISAliq>
                            <CST>{$this->request['NFe']['infNFe']['det']['imposto']['PIS']['PISAliq']['CST']}</CST>
                            <vBC>{$this->request['NFe']['infNFe']['det']['imposto']['PIS']['PISAliq']['vBC']}</vBC>
                            <pPIS>{$this->request['NFe']['infNFe']['det']['imposto']['PIS']['PISAliq']['pPIS']}</pPIS>
                            <vPIS>{$this->request['NFe']['infNFe']['det']['imposto']['PIS']['PISAliq']['vPIS']}</vPIS>
                        </PISAliq>
                    </PIS>
                    <COFINS>
                        <COFINSAliq>
                            <CST>{$this->request['NFe']['infNFe']['det']['imposto']['COFINS']['COFINSAliq']['CST']}</CST>
                            <vBC>{$this->request['NFe']['infNFe']['det']['imposto']['COFINS']['COFINSAliq']['vBC']}</vBC>
                            <pCOFINS>{$this->request['NFe']['infNFe']['det']['imposto']['COFINS']['COFINSAliq']['pCOFINS']}</pCOFINS>
                            <vCOFINS>{$this->request['NFe']['infNFe']['det']['imposto']['COFINS']['COFINSAliq']['vCOFINS']}</vCOFINS>
                        </COFINSAliq>
                    </COFINS>
                </imposto>
            </det>
            <total>
                <ICMSTot>
                    <vBC>{$this->request['NFe']['infNFe']['total']['ICMSTot']['vBC']}</vBC>
                    <vICMS>{$this->request['NFe']['infNFe']['total']['ICMSTot']['vICMS']}</vICMS>
                    <vBCST>{$this->request['NFe']['infNFe']['total']['ICMSTot']['vBCST']}</vBCST>
                    <vST>{$this->request['NFe']['infNFe']['total']['ICMSTot']['vST']}</vST>
                    <vProd>{$this->request['NFe']['infNFe']['total']['ICMSTot']['vProd']}</vProd>
                    <vFrete>{$this->request['NFe']['infNFe']['total']['ICMSTot']['vFrete']}</vFrete>
                    <vSeg>{$this->request['NFe']['infNFe']['total']['ICMSTot']['vSeg']}</vSeg>
                    <vDesc>{$this->request['NFe']['infNFe']['total']['ICMSTot']['vDesc']}</vDesc>
                    <vII>{$this->request['NFe']['infNFe']['total']['ICMSTot']['vII']}</vII>
                    <vIPI>{$this->request['NFe']['infNFe']['total']['ICMSTot']['vIPI']}</vIPI>
                    <vPIS>{$this->request['NFe']['infNFe']['total']['ICMSTot']['vPIS']}</vPIS>
                    <vCOFINS>{$this->request['NFe']['infNFe']['total']['ICMSTot']['vCOFINS']}</vCOFINS>
                    <vOutro>{$this->request['NFe']['infNFe']['total']['ICMSTot']['vOutro']}</vOutro>
                    <vNF>{$this->request['NFe']['infNFe']['total']['ICMSTot']['vNF']}</vNF>
                </ICMSTot>
            </total>
            <transp>
                <modFrete>{$this->request['NFe']['infNFe']['transp']['modFrete']}</modFrete>
            </transp>
        </infNFe>
    </NFe>
</enviNFe>
EOF;
        return $this->xml;
    }

    /**
     * Método que retorna o XML de Exemplo
     * 
     * @author Eric Maicon
     */
    public function getXmlExample() {
        return <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<enviNFe versao="" xmlns="http://www.portalfiscal.inf.br/nfe"
    xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.portalfiscal.inf.br/nfe enviNFe_v2.00.xsd ">
    <idLote>idLote</idLote>
    <NFe>
        <infNFe Id="" versao="">
            <ide>
                <cUF>11</cUF>
                <cNF>cNF</cNF>
                <natOp>natOp</natOp>
                <indPag>0</indPag>
                <mod>55</mod>
                <serie>serie</serie>
                <nNF>nNF</nNF>
                <dEmi>dEmi</dEmi>
                <tpNF>0</tpNF>
                <cMunFG>cMunFG</cMunFG>
                <tpImp>1</tpImp>
                <tpEmis>1</tpEmis>
                <cDV>cDV</cDV>
                <tpAmb>1</tpAmb>
                <finNFe>1</finNFe>
                <procEmi>0</procEmi>
                <verProc>verProc</verProc>
            </ide>
            <emit>
                <CNPJ>CNPJ</CNPJ>
                <xNome>xNome</xNome>
                <enderEmit>
                    <xLgr>xLgr</xLgr>
                    <nro>nro</nro>
                    <xBairro>xBairro</xBairro>
                    <cMun>cMun</cMun>
                    <xMun>xMun</xMun>
                    <UF>AC</UF>
                    <CEP>CEP</CEP>
                </enderEmit>
                <IE>IE</IE>
                <CRT>1</CRT>
            </emit>
            <dest>
                <CNPJ>CNPJ</CNPJ>
                <xNome>xNome</xNome>
                <enderDest>
                    <xLgr>xLgr</xLgr>
                    <nro>nro</nro>
                    <xBairro>xBairro</xBairro>
                    <cMun>cMun</cMun>
                    <xMun>xMun</xMun>
                    <UF>AC</UF>
                </enderDest>
                <IE>IE</IE>
            </dest>
            <det nItem="">
                <prod>
                    <cProd>cProd</cProd>
                    <cEAN>cEAN</cEAN>
                    <xProd>xProd</xProd>
                    <NCM>NCM</NCM>
                    <CFOP>1101</CFOP>
                    <uCom>uCom</uCom>
                    <qCom>qCom</qCom>
                    <vUnCom>vUnCom</vUnCom>
                    <vProd>vProd</vProd>
                    <cEANTrib>cEANTrib</cEANTrib>
                    <uTrib>uTrib</uTrib>
                    <qTrib>qTrib</qTrib>
                    <vUnTrib>vUnTrib</vUnTrib>
                    <indTot>0</indTot>
                </prod>
                <imposto>
                    <PIS>
                        <PISAliq>
                            <CST>01</CST>
                            <vBC>vBC</vBC>
                            <pPIS>pPIS</pPIS>
                            <vPIS>vPIS</vPIS>
                        </PISAliq>
                    </PIS>
                    <COFINS>
                        <COFINSAliq>
                            <CST>01</CST>
                            <vBC>vBC</vBC>
                            <pCOFINS>pCOFINS</pCOFINS>
                            <vCOFINS>vCOFINS</vCOFINS>
                        </COFINSAliq>
                    </COFINS>
                </imposto>
            </det>
            <total>
                <ICMSTot>
                    <vBC>vBC</vBC>
                    <vICMS>vICMS</vICMS>
                    <vBCST>vBCST</vBCST>
                    <vST>vST</vST>
                    <vProd>vProd</vProd>
                    <vFrete>vFrete</vFrete>
                    <vSeg>vSeg</vSeg>
                    <vDesc>vDesc</vDesc>
                    <vII>vII</vII>
                    <vIPI>vIPI</vIPI>
                    <vPIS>vPIS</vPIS>
                    <vCOFINS>vCOFINS</vCOFINS>
                    <vOutro>vOutro</vOutro>
                    <vNF>vNF</vNF>
                </ICMSTot>
            </total>
            <transp>
                <modFrete>0</modFrete>
            </transp>
        </infNFe>
        <ds:Signature>
            <ds:SignedInfo>
                <ds:CanonicalizationMethod
                    Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" />
                <ds:SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1" />
                <ds:Reference URI="http://tempuri.org">
                    <ds:Transforms>
                        <ds:Transform
                            Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature" />
                        <ds:Transform
                            Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature" />
                    </ds:Transforms>
                    <ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1" />
                    <ds:DigestValue>MA==</ds:DigestValue>
                </ds:Reference>
            </ds:SignedInfo>
            <ds:SignatureValue>MA==</ds:SignatureValue>
            <ds:KeyInfo>
                <ds:X509Data>
                    <ds:X509Certificate>MA==</ds:X509Certificate>
                </ds:X509Data>
            </ds:KeyInfo>
        </ds:Signature>
    </NFe>
</enviNFe>
EOF;
    }

    /**
     * Método que retorna o XML já envelopado
     * 
     * @param $xml
     * @author Eric Maicon
     */
    protected function getEnvelopedXml($xml) {
        return <<<EOF
<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Header>
    <nfeCabecMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/NfeRecepcao2">
      <cUF>{$this->request['UF']}</cUF>
      <versaoDados>{$this->versao}</versaoDados>
    </nfeCabecMsg>
  </soap12:Header>
  <soap12:Body>
    <nfeDadosMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/NfeRecepcao2">
    {$xml}
    </nfeDadosMsg>
  </soap12:Body>
</soap12:Envelope>
EOF;
    }

    /**
     * Método que retorna o Id
     * no Manual: 5.4 Chave de Acesso da NF-e
     * 
     * @param $uf
     * @param $data
     * @param $cnpj
     * @param $mod
     * @param $serie
     * @param $nNF
     * @param $cNF
     * @author Eric Maicon
     */
    public static function calcularId($uf, $data, $cnpj, $mod, $serie, $nNF, $tpEmiss, $cNF) {
        $retorno = '';
        $retorno .= \NFe::getUfCode($uf);
        $retorno .= date("ym", strtotime($data));
        $retorno .= $cnpj;
        $retorno .= $mod;
        $retorno .= $serie;
        $retorno .= $nNF;
        $retorno .= $tpEmiss;
        $retorno .= $cNF;
        echo $retorno;
        exit;
        $retorno .= self::calcularDigitoVerificador($retorno);

        return $retorno;
    }

    /**
     * O dígito verificador da chave de acesso da NF-e é baseado em um cálculo do módulo 11.
     * O módulo 11 de um número é calculado multiplicando-se cada algarismo pela sequência de multiplicadores 2,3,4,5,6,7,8,9,2,3, ... posicionados da direita para a esquerda.
     * A somatória dos resultados das ponderações dos algarismos é dividida por 11 e o DV (dígito verificador) será a diferença entre o divisor (11) e o resto da divisão:
     * http://www.rafaeltheodoro.com.br/tag/digito-verificador/
     *
     * @param $chave
     * @author Eric Maicon
     */
    public static function calcularDigitoVerificador($chave) {
        $base = 9;
        $result = 0;
        $sum = 0;
        $factor = 2;
         
        for($i = strlen($chave); $i > 0; $i--) {
            $numbers[$i] = substr($chave,$i-1,1);
            $partial[$i] = $numbers[$i] * $factor;
            $sum += $partial[$i];
            
            if($factor == $base) {
                $factor = 1;
            }
         
            $factor++;
        }
         
        if($result == 0) {
            $sum *= 10;
            $digit = $sum % 11;
            if($digit == 10) {
                $digit = 0;
            }
        
            return $digit;
        } elseif($result == 1) {
            $rest = $sum % 11;
            return $rest;
        }
    }
}