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
     * Método que retorna o XML Pronto
     * 
     * @throws
     * @author Eric Maicon
     */
    public function getXml() {
        $this->xml = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<ConsCad versao="token" xmlns="http://www.portalfiscal.inf.br/nfe"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.portalfiscal.inf.br/nfe {$this->model->xsd} ">
    <infCons>
        <xServ>{$this->model->xServ}</xServ>
        <UF>{$this->model->UF}</UF>
        <IE>{$this->model->IE}</IE>
    </infCons>
</ConsCad>
EOF;
        return $this->xml;
    }

    /**
     * Método que retorna o XML de Exemplo
     * 
     * @throws
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
     * @throws
     * @author Eric Maicon
     */
    protected function envelopa() {
        return <<<EOF
<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Header>
    <nfeCabecMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/CadConsultaCadastro2">
      <cUF>string</cUF>
      <versaoDados>string</versaoDados>
    </nfeCabecMsg>
  </soap12:Header>
  <soap12:Body>
    <nfeDadosMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/CadConsultaCadastro2">
    {$this->getXML()}
    </nfeDadosMsg>
  </soap12:Body>
</soap12:Envelope>
EOF;
    }

}