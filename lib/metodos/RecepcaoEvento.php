<?php

namespace metodos;

/**
 * Histórico de alterações:
 * {dd/mm/yyyy} {autor} {descrição}
 * 
 **/

/**
 * Classe que consome o webservice RecepcaoEvento
 * 
 * @class RecepcaoEvento
 * @version <1.0.0>
 * @date 18/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class RecepcaoEvento extends \metodos\NFeMetodo {

    /**
     * Sobreescrita do construtor para setar as variáveis
     * 
     * @param $request
     * @author Eric Maicon
     */
    public function __construct($request = null) {
        $this->versao = '1.00';
        $this->xsd = 'eventoCancNFe_v1.00.xsd';
        $this->servico = 'RecepcaoEvento';
        $this->tagToSign = 'infEvento';

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

        $this->xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><evento versao=\"{$this->versao}\" xmlns=\"http://www.portalfiscal.inf.br/nfe\">";
        $this->xml .= \helpers\ObjectHelper::objectToStringXml($this->request);
        $this->xml .= "</evento>";

        //TODO: melhorar
        $this->xml = str_replace("<infEvento>", "<infEvento Id=\"{$id}\">", $this->xml);
        $this->xml = str_replace("<detEvento>", "<detEvento versao=\"{$this->versao}\">", $this->xml);

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
<evento versao="" xmlns="http://www.portalfiscal.inf.br/nfe"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.portalfiscal.inf.br/nfe eventoCancNFe_v1.00.xsd ">
    <infEvento Id="">
        <cOrgao>11</cOrgao>
        <tpAmb>1</tpAmb>
        <CNPJ>CNPJ</CNPJ>
        <chNFe>chNFe</chNFe>
        <dhEvento>dhEvento</dhEvento>
        <tpEvento>110111</tpEvento>
        <nSeqEvento>nSeqEvento</nSeqEvento>
        <verEvento>1.00</verEvento>
        <detEvento versao="1.00">
            <descEvento>Cancelamento</descEvento>
            <nProt>nProt</nProt>
            <xJust>xJust</xJust>
        </detEvento>
    </infEvento>
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
</evento>
EOF;
    }

    /**
     * Método que retorna o XML já envelopado
     * 
     * @param $xml
     * @author Eric Maicon
     */
    protected function getEnvelopedXml($xml) {
        $uf = \NFe::getUfCode($this->UF);

        return <<<EOF
<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Header>
    <nfeCabecMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/RecepcaoEvento">
      <cUF>{$uf}</cUF>
      <versaoDados>{$this->versao}</versaoDados>
    </nfeCabecMsg>
  </soap12:Header>
  <soap12:Body>
    <nfeDadosMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/RecepcaoEvento">
    {$xml}
    </nfeDadosMsg>
  </soap12:Body>
</soap12:Envelope>
EOF;
    }

    /**
     * Método que retorna o Id
     * no Manual: Identificador da TAG a ser assinada, a regra de formação do Id é: “ID” + tpEvento + chave da NF-e + nSeqEvento
     * 
     * @author Eric Maicon
     */
    public static function calcularId($request) {
        $tpEvento = $request->infEvento->tpEvento;
        $chNFe = $request->infEvento->chNFe;
        $nSeqEvento = $request->infEvento->nSeqEvento;

        // if(strlen($cUF) != 2) {
        //     throw new \exceptions\InvalidIdParamException("O UF (cUF) deve ter 2 dígitos");
        // }

        // if(strlen($ano) != 2) {
        //     throw new \exceptions\InvalidIdParamException("O ano (ano) deve ter 2 dígitos");
        // }

        // if(strlen($cnpj) != 14) {
        //     throw new \exceptions\InvalidIdParamException("O CNPJ (cnpj) deve ter 14 dígitos");
        // }

        $retorno = 'ID';
        $retorno .= $tpEvento;
        $retorno .= $chNFe;
        $retorno .= $nSeqEvento;

        return $retorno;
    }

}