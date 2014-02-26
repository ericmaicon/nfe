<?php

namespace metodos;

/**
 * Histórico de alterações:
 * {dd/mm/yyyy} {autor} {descrição}
 * 
 **/

/**
 * Classe abstrata que contém os métodos essenciais para o funcionamento do projeto
 * 
 * @class NFe
 * @version <1.0.0>
 * @date 08/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
abstract class NFeMetodo {

    protected $request;
    protected $response;

    protected $xsd;
    public $versao;
    public $servico;
    protected $signable = true;
    
    private $doc;
    private $xml;
    private $signedXml;
    protected $encapsulatedXml;
    
    /**
     * Método construtor que preenche a classe
     * 
     * @param $request
     * @author Eric Maicon
     */
    public function __construct($request = null) {
        if(!isset($request)) {
            throw new \exceptions\MissingParameterException("Para que seja criado o XML, é necessário passar o request com os valores de cada TAG para o método construtor.");
        }

        $this->request = $request;
    }

    /**
     * Método que retorna o XML Pronto
     * 
     * @author Eric Maicon
     */
    public abstract function getXml();

    /**
     * Método que retorna o XML de Exemplo
     * 
     * @author Eric Maicon
     */
    public abstract function getXmlExample();

    /**
     * Método que retorna o XML já envelopado
     * 
     * @author Eric Maicon
     */
    protected abstract function getEnvelopedXml($xml);

    /**
     * Assina o XML
     * 
     * @author Eric Maicon
     */
    public function sign() {
        if(isset($this->signedXml)) {
            return $this->signedXml;
        }

        //transformando o xml em um DOM
        $this->doc = new \DOMDocument();
        $this->doc->loadXml($this->getXml());

        //é assinável?
        if($this->signable) {
            //carregando a chave
        //     $chave = \helpers\FileHelper::valida(\NFe::getBasePath() . \NFe::CERT_DIR . \NFe::get("certificado", "chave"));

        //     //carregando o certificado
        //     $certificado = \helpers\FileHelper::valida(\NFe::getBasePath() . \NFe::CERT_DIR . \NFe::get("certificado", "certificado"));

        //     //Começando a assinatura
        //     $objDSig = new \XMLSecurityDSig();
        //     $objDSig->setCanonicalMethod(\XMLSecurityDSig::EXC_C14N);
        //     $objDSig->addReference($doc, \XMLSecurityDSig::SHA1, array('http://www.w3.org/2000/09/xmldsig#enveloped-signature', 'http://www.w3.org/2001/10/xml-exc-c14n#'));
        //     $objKey = new \XMLSecurityKey(\XMLSecurityKey::RSA_SHA1, array('type' => 'private'));
        //     $objKey->loadKey($chave, TRUE);
        //     $objDSig->sign($objKey);
        //     $objDSig->add509Cert(file_get_contents($certificado));
        //     $objDSig->appendSignature($this->doc->documentElement);
        }

        $this->signedXml = $this->doc->saveXml();

        return $this->signedXml;
    }

    /**
     * Valida com o XSD se está com toda a estrutura correta
     * 
     * @author Eric Maicon
     */
    public function validate() {
        $this->sign();

        //carregando o xsd
        $xsd = \helpers\FileHelper::valida(\NFe::getBasePath() . \NFe::XSD_DIR . $this->xsd);

        return $this->doc->schemaValidate($xsd);
    }

    /**
     * Envelopa o XML
     * 
     * @author Eric Maicon
     */
    public function envelop() {
        if(isset($this->encapsulatedXml)) {
            return $this->encapsulatedXml;
        }

        //removendo o cabeçalho do xml, pois ele fica no encapsulamento
        $xml = $this->sign();
        $xml = str_replace("<?xml version=\"1.0\" encoding=\"UTF-8\"?>", "", $xml);

        $this->encapsulatedXml = $this->treatXml($this->getEnvelopedXml($xml));

        return $this->encapsulatedXml;
    }

    /**
     * Remove tabs e espaços do XML
     *
     * @author Eric Maicon
     */
    private function treatXml($xml) {
        $xml = preg_replace('/(\s\s+|\t|\n)/', '', $xml);

        return $xml;
    }

    /**
     * Enviar para o SEFAZ 
     *
     * @param $responseFile
     * @author Eric Maicon
     */
    public function send() {
        if($this->validate()) {

            //carregando o certificado
            $certificado = \helpers\FileHelper::valida(\NFe::getBasePath() . \NFe::CERT_DIR . \NFe::get("certificado", "certificado"));


            //pegando a url
            $url = \NFe::get($this->request['UF'], $this->servico);

            //envelopando o XML
            $xmlFinal = $this->envelop();

            //Enviando para o SEFAZ
            $response = \helpers\CurlHelper::send($url, $certificado, $xmlFinal);

            $arrayDeValores = \helpers\ArrayHelper::xmlToArray($response);
            return $arrayDeValores;
        } else {
            throw new \exceptions\NfeException("XML não validado. Verifique!");
        }
    }

}