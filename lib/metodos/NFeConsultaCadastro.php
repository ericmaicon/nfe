<?php

namespace metodos;

/**
 * Histórico de alterações:
 * {dd/mm/yyyy} {autor} {descrição}
 * 
 **/

/**
 * Classe que consome o webservice NfeConsultaCadastro
 * 
 * @class NFeConsultaCadastro
 * @version <1.0.0>
 * @date 08/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class NFeConsultaCadastro extends \metodos\NFeMetodo {

    /**
     * Sobreescrita do construtor para setar o signable como false
     * 
     * @param $request
     * @author Eric Maicon
     */
    public function __construct($request = null) {
        $this->signable = false;

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
<ConsCad versao="{$this->request->versao}" xmlns="http://www.portalfiscal.inf.br/nfe"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.portalfiscal.inf.br/nfe {$this->request->xsd} ">
    <infCons>
        <xServ>{$this->request->xServ}</xServ>
        <UF>{$this->request->UF}</UF>
        <IE>{$this->request->IE}</IE>
    </infCons>
</ConsCad>
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
<ConsCad versao="token" xmlns="http://www.portalfiscal.inf.br/nfe"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.portalfiscal.inf.br/nfe consCad_v2.00.xsd ">
    <infCons>
        <xServ>xServ</xServ>
        <UF>AC</UF>
        <IE>IE</IE>
    </infCons>
</ConsCad>
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
    <nfeCabecMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/CadConsultaCadastro2">
      <cUF>{$this->request->UF}</cUF>
      <versaoDados>{$this->request->versao}</versaoDados>
    </nfeCabecMsg>
  </soap12:Header>
  <soap12:Body>
    <nfeDadosMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/CadConsultaCadastro2">
    {$xml}
    </nfeDadosMsg>
  </soap12:Body>
</soap12:Envelope>
EOF;
    }

}