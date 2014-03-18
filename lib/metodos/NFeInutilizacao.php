<?php

namespace metodos;

/**
 * Histórico de alterações:
 * {dd/mm/yyyy} {autor} {descrição}
 * 
 **/

/**
 * Classe que consome o webservice NFeInutilizacao
 * 
 * @class NFeInutilizacao
 * @version <1.0.0>
 * @date 18/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class NFeInutilizacao extends \metodos\NFeMetodo {

    /**
     * Sobreescrita do construtor para setar as variáveis
     * 
     * @param $request
     * @author Eric Maicon
     */
    public function __construct($request = null) {
        $this->versao = '2.00';
        $this->xsd = 'inutNFe_v2.00.xsd';
        $this->servico = 'NfeInutilizacao';
        $this->tagToSign = 'infInut';

        parent::__construct($request);
    }

    /**
     * Método que retorna o XML Pronto
     * 
     * @author Eric Maicon
     */
    public function getXml() {
        if(!isset($this->request->NFe->infNFe->Id)) {
            $id = self::calcularId($this->request);
        }

        $this->xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><inutNFe versao=\"{$this->versao}\" xmlns=\"http://www.portalfiscal.inf.br/nfe\">";
        $this->xml .= \helpers\ObjectHelper::objectToStringXml($this->request);
        $this->xml .= "</inutNFe>";

        //TODO: melhorar
        $this->xml = str_replace("<infInut>", "<infInut Id=\"{$id}\">", $this->xml);

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
<inutNFe versao="token" xmlns="http://www.portalfiscal.inf.br/nfe"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.portalfiscal.inf.br/nfe inutNFe_v2.00.xsd ">
    <infInut Id="">
        <tpAmb>1</tpAmb>
        <xServ>xServ</xServ>
        <cUF>11</cUF>
        <ano>ano</ano>
        <CNPJ>CNPJ</CNPJ>
        <mod>55</mod>
        <serie>serie</serie>
        <nNFIni>nNFIni</nNFIni>
        <nNFFin>nNFFin</nNFFin>
        <xJust>xJust</xJust>
    </infInut>
    <Signature>
        <SignedInfo>
            <CanonicalizationMethod
                Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" />
            <SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1" />
            <Reference URI="http://tempuri.org">
                <Transforms>
                    <Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature" />
                    <Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature" />
                </Transforms>
                <DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1" />
                <DigestValue>MA==</DigestValue>
            </Reference>
        </SignedInfo>
        <SignatureValue>MA==</SignatureValue>
        <KeyInfo>
            <X509Data>
                <X509Certificate>MA==</X509Certificate>
            </X509Data>
        </KeyInfo>
    </Signature>
</inutNFe>
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
    <nfeCabecMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/NfeInutilizacao2">
      <cUF>{$this->UF}</cUF>
      <versaoDados>{$this->versao}</versaoDados>
    </nfeCabecMsg>
  </soap12:Header>
  <soap12:Body>
    <nfeDadosMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/NfeInutilizacao2">
    {$xml}
    </nfeDadosMsg>
  </soap12:Body>
</soap12:Envelope>
EOF;
    }

    /**
     * Método que retorna o Id
     * no Manual: Identificador da TAG a ser assinada formada com Código da UF + Ano (2 posições) + CNPJ + modelo + série + nro inicial e nro final precedida do literal “ID”
     * 
     * @author Eric Maicon
     */
    public static function calcularId($request) {
        $cUF = $request->infInut->cUF;
        $ano = $request->infInut->ano;
        $cnpj = $request->infInut->CNPJ;
        $mod = $request->infInut->mod;
        $serie = str_pad($request->infInut->serie, 3, 0, STR_PAD_LEFT);
        $nNFIni = $request->infInut->nNFIni; 
        $nNFFin = $request->infInut->nNFFin;

        if(strlen($cUF) != 2) {
            throw new \exceptions\InvalidIdParamException("O UF (cUF) deve ter 2 dígitos");
        }

        if(strlen($ano) != 2) {
            throw new \exceptions\InvalidIdParamException("O ano (ano) deve ter 2 dígitos");
        }

        if(strlen($cnpj) != 14) {
            throw new \exceptions\InvalidIdParamException("O CNPJ (cnpj) deve ter 14 dígitos");
        }

        if(strlen($mod) != 2) {
            throw new \exceptions\InvalidIdParamException("O modelo (mod) deve ter 2 dígitos");
        }

        if(strlen($serie) != 3) {
            throw new \exceptions\InvalidIdParamException("A série (serie) deve ter 3 dígitos");
        }

        if(strlen($nNFIni) != 9) {
            throw new \exceptions\InvalidIdParamException("O número da nota (nNFIni) deve ter 9 dígitos");
        }

        if(strlen($nNFFin) != 9) {
            throw new \exceptions\InvalidIdParamException("O código númerico (nNFFin) deve ter 9 dígitos");
        }

        $retorno = 'ID';
        $retorno .= $cUF;
        $retorno .= $ano;
        $retorno .= $cnpj;
        $retorno .= $mod;
        $retorno .= $serie;
        $retorno .= $nNFIni;
        $retorno .= $nNFFin;

        return $retorno;
    }

}