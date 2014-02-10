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

    protected $model;
    protected $xml;
    protected $assignedXml;
    protected $encapsulatedXml;
    
    /**
     * Método construtor que preenche a classe
     * 
     * @param $array
     * @throws
     * @author Eric Maicon
     */
    public function __construct($model = null) {
        if(!isset($model)) {
            throw new \exceptions\MissingParameterException("Para que seja criado o XML, é necessário passar o model com os valores de cada TAG para o método construtor.");
        }

        if(!($model instanceof \parametros\NFeModel)) {
            throw new \exceptions\WrongParameterException("O Parâmetro deve ser do tipo NFeModel.");
        }

        $this->model = $model;
    }

    /**
     * Método que retorna o XML Pronto
     * 
     * @throws
     * @author Eric Maicon
     */
    public abstract function getXml();

    /**
     * Método que retorna o XML de Exemplo
     * 
     * @throws
     * @author Eric Maicon
     */
    public abstract function getXmlExample();

    /**
     * Método que retorna o XML já envelopado
     * 
     * @throws
     * @author Eric Maicon
     */
    protected abstract function envelopa();

    /**
     * Assina o XML
     * 
     * @throws
     * @author Eric Maicon
     */
    public function sign() {
        if(!isset($this->xml)) {
            $this->getXml();
        }

        // var_dump(\NFe::get("certificado", "certificado"));

        $doc = new \DOMDocument();
        $doc->loadXml($this->xml);
        // $objDSig = new \XMLSecurityDSig();
        // $objDSig->setCanonicalMethod(\XMLSecurityDSig::EXC_C14N);
        // $objDSig->addReference($doc, \XMLSecurityDSig::SHA1, array('http://www.w3.org/2000/09/xmldsig#enveloped-signature', 'http://www.w3.org/2001/10/xml-exc-c14n#'));
        // $objKey = new \XMLSecurityKey(\XMLSecurityKey::RSA_SHA1, array('type'=>'private'));
        // $objKey->loadKey(dirname(__FILE__) . 'privateKeyNoPass.pem', TRUE);
        // $objDSig->sign($objKey);
        // $objDSig->add509Cert(file_get_contents(dirname(__FILE__) . 'cert.pem'));
        // $objDSig->appendSignature($doc->documentElement);
        // $doc->save(dirname(__FILE__) . 'signed.xml');
    }

    /**
     * 
     * 
     * @throws
     * @author Eric Maicon
     */
    public function validate() {
        //TODO
        echo "validando";
    }

    /**
     * 
     * 
     * @param page
     * @param pageable
     * @param indrCriticidade
     * @throws
     * @author Eric Maicon
     */
    public function send() {
        //TODO
        echo "enviando";
    }

}