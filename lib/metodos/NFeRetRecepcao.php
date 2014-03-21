<?php

namespace metodos;

/**
 * Histórico de alterações:
 * {dd/mm/yyyy} {autor} {descrição}
 * 
 **/

/**
 * Classe que consome o webservice NfeRetRecepcao
 * 
 * @class NfeRetRecepcao
 * @version <1.0.0>
 * @date 18/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class NfeRetRecepcao extends \metodos\NFeMetodo {

    /**
     * Sobreescrita do construtor para setar as variáveis
     * 
     * @param $request
     * @author Eric Maicon
     */
    public function __construct($request = null) {
        $this->versao = '2.00';
        $this->xsd = 'consReciNFe_v2.00.xsd';
        $this->servico = 'NfeRetRecepcao';
        $this->signable = false;

        parent::__construct($request);
    }

    /**
     * Método que retorna o XML Pronto
     * 
     * @author Eric Maicon
     */
    public function getXml() {
        $this->xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><consReciNFe versao=\"{$this->versao}\" xmlns=\"http://www.portalfiscal.inf.br/nfe\">";
        $this->xml .= \helpers\ObjectHelper::objectToStringXml($this->request);
        $this->xml .= "</consReciNFe>";

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
<consReciNFe versao="" xmlns="http://www.portalfiscal.inf.br/nfe" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.portalfiscal.inf.br/nfe consReciNFe_v2.00.xsd ">
  <tpAmb>1</tpAmb>
  <nRec>nRec</nRec>
</consReciNFe>
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
    <nfeCabecMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/NfeRetRecepcao2">
      <cUF>{$uf}</cUF>
      <versaoDados>{$this->versao}</versaoDados>
    </nfeCabecMsg>
  </soap12:Header>
  <soap12:Body>
    <nfeDadosMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/NfeRetRecepcao2">
    {$xml}
    </nfeDadosMsg>
  </soap12:Body>
</soap12:Envelope>
EOF;
    }

}