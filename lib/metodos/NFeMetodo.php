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

    public $versao;
    public $UF;
    public $xsd;

    protected $servico;
    protected $signable = true;
    protected $tagToSign;
    
    /**
     * Método construtor que preenche a classe
     * 
     * @param $request
     * @author Eric Maicon
     */
    public function __construct($request = null) {
        $this->request = \helpers\ArrayHelper::arrayToBean($request);
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

    /**""
     * Assina o XML
     * Créditos: https://www.assembla.com/code/nfephp/subversion/nodes/658/branches/2.0/libs/ToolsNFePHP.class.php
     * Nenhuma parte desse método foi mérito meu. Todo o código foi copiado do link acima
     * Autor no link: Roberto L. Machado <linux.rlm at gmail dot com>
     * 
     * @param $tag
     * @author Eric Maicon
     */
    public function sign($xml, $tag = null) {
        //transformando o xml em um DOM
        $doc = new \DOMDocument('1.0', 'utf-8');
        $doc->preservWhiteSpace = false;
        $doc->formatOutput = false;
        $doc->loadXml($this->getXml(),LIBXML_NOBLANKS | LIBXML_NOEMPTYTAG);

        //é assinável?
        if($this->signable) {
            $chave = \NFe::getBasePath() . \NFe::CERT_DIR . \NFe::get("seguranca", "chave");

            \helpers\XmlHelper::sign($doc, $tag, $chave);
        }

        return $doc->saveXml();
    }

    /**
     * Valida com o XSD se está com toda a estrutura correta
     * 
     * @author Eric Maicon
     */
    public function validate($xml) {
        //carregando o xsd
        $xsd = \helpers\FileHelper::valida(\NFe::getBasePath() . \NFe::XSD_DIR . $this->xsd);

        //Cria o DOM Document para validar o schema
        $doc = new \DOMDocument('1.0', 'utf-8');
        $doc->preservWhiteSpace = false;
        $doc->formatOutput = false;
        $doc->loadXml($xml,LIBXML_NOBLANKS | LIBXML_NOEMPTYTAG);

        return $doc->schemaValidate($xsd);
    }

    /**
     * Envelopa o XML
     * 
     * @author Eric Maicon
     */
    public function envelop($xml) {
        //removendo o cabeçalho do xml, pois ele fica no encapsulamento
        $xml = str_replace("<?xml version=\"1.0\" encoding=\"UTF-8\"?>", "", $xml);

        //remove os espaços do xml
        $this->encapsulatedXml = \helpers\XmlHelper::treatXml($this->getEnvelopedXml($xml));

        return $this->encapsulatedXml;
    }

    /**
     * Enviar para o SEFAZ 
     *
     * @param $xml
     * @param $returnXml
     * @author Eric Maicon
     */
    public function send($xml = null, $envelop = true, $sign = true, $returnXml = false) {
        //Se o usuário quiser só enviar um xml que ele tenha, só passar como parâmetro
        //Senão, o sistema cria.
        if(!isset($xml)) {
            $xml = $this->getXml();
        }

        //Se o usuário quiser assinar
        if($this->signable && $sign) {
            $xml = $this->sign($xml, $this->tagToSign);
        }

        //Valida o xml
        if($this->validate($xml)) {
            //carregando o certificado
            $certificado = \helpers\FileHelper::valida(\NFe::getBasePath() . \NFe::CERT_DIR . \NFe::get("seguranca", "chave"));

            //pegando a url
            $url = \NFe::get($this->UF, $this->servico);

            //Se o usuário quiser envelopar, ele deixa a variável true
            //Senão, se o xml fornecido já estiver envelopado, ele coloca false
            if($envelop) {
                $xml = $this->envelop($xml);
            }
            //Enviando para o SEFAZ
            $response = \helpers\CurlHelper::send($url, $certificado, $xml);

            //Se o usuário quiser o xml retornado pelo SEFAZ:
            //Senão, o sistema converte para Array.
            if($returnXml) {
                return $response;
            } else {
                $arrayDeValores = \helpers\ArrayHelper::xmlToArray($response);
                return $arrayDeValores;
            }
        } else {
            throw new \exceptions\NfeException("XML não validado. Verifique!");
        }
    }

}