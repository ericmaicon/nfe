<?php

namespace metodos;

/**
 * Histórico de alterações:
 * {dd/mm/yyyy} {autor} {descrição}
 * 
 **/

/**
 * Classe que consome o webservice NFeConsulta
 * 
 * @class NFeConsulta
 * @version <1.0.0>
 * @date 18/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class NFeConsulta extends \metodos\NFeMetodo {

    /**
     * Sobreescrita do construtor para setar as variáveis
     * 
     * @param $request
     * @author Eric Maicon
     */
    public function __construct($request = null) {
        $this->versao = '2.01';
        $this->xsd = 'consSitNFe_v2.01.xsd';
        $this->servico = 'NfeConsultaProtocolo';
        $this->signable = false;

        parent::__construct($request);
    }

    /**
     * Método que retorna o XML Pronto
     * 
     * @author Eric Maicon
     */
    public function getXml() {
        $this->xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><consSitNFe versao=\"{$this->versao}\" xmlns=\"http://www.portalfiscal.inf.br/nfe\">";
        $this->xml .= \helpers\ObjectHelper::objectToStringXml($this->request);
        $this->xml .= "</consSitNFe>";

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
<consSitNFe versao="token" xmlns="http://www.portalfiscal.inf.br/nfe"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.portalfiscal.inf.br/nfe consSitNFe_v2.00.xsd ">
    <tpAmb>1</tpAmb>
    <xServ>xServ</xServ>
    <chNFe>chNFe</chNFe>
</consSitNFe>
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
    <nfeCabecMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/NfeConsulta2">
      <cUF>{$this->UF}</cUF>
      <versaoDados>{$this->versao}</versaoDados>
    </nfeCabecMsg>
  </soap12:Header>
  <soap12:Body>
    <nfeDadosMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/NfeConsulta2">
    {$xml}
    </nfeDadosMsg>
  </soap12:Body>
</soap12:Envelope>
EOF;
    }

}