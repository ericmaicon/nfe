<?php

namespace helpers;

/**
 * Histórico de alterações:
 * {dd/mm/yyyy} {autor} {descrição}
 * 27/03/2014   Eric    Coloquei para o treatXml tratar espaços
 * 
 **/

/**
 * Classe com funções de assinatura do DOM XML
 * 
 * @class XmlHelper
 * @version <1.0.0>
 * @date 18/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class XmlHelper {

    private static $URLdsig = 'http://www.w3.org/2000/09/xmldsig#';
    private static $URLCanonMeth = 'http://www.w3.org/TR/2001/REC-xml-c14n-20010315';
    private static $URLSigMeth = 'http://www.w3.org/2000/09/xmldsig#rsa-sha1';
    private static $URLTransfMeth_1 = 'http://www.w3.org/2000/09/xmldsig#enveloped-signature';
    private static $URLTransfMeth_2 = 'http://www.w3.org/TR/2001/REC-xml-c14n-20010315';
    private static $URLDigestMeth='http://www.w3.org/2000/09/xmldsig#sha1';

    /**
     * Remove tabs e espaços do XML
     *
     * @author Eric Maicon
     */
    public static function treatXml($xml) {
        $xml = preg_replace('/(\s\s+|\t|\n)/', '', $xml);
        $xml = preg_replace('/\s{2,}/', ' ', $xml);
        $xml = trim($xml);

        return $xml;
    }

    /**
     * Assina o DOM
     * Créditos: https://www.assembla.com/code/nfephp/subversion/nodes/658/branches/2.0/libs/ToolsNFePHP.class.php
     * Nenhuma parte desse método foi mérito meu. Todo o código foi copiado do link acima
     * Autor no link: Roberto L. Machado <linux.rlm at gmail dot com>
     * 
     * @param $doc
     * @param $tag
     * @param $certificado
     * @author Eric Maicon
     */
    public static function sign($doc, $tagName, $chave) {
        // obter o chave privada para assinatura
        $chaveContent = file_get_contents($chave);
        $pkeyid = openssl_get_privatekey($chaveContent);

        //extrair a tag com os dados a serem assinados
        if($tagName) {
            $node = $doc->getElementsByTagName($tagName)->item(0);
            $id = $node->getAttribute("Id");
            $root = $node->parentNode;
        } else {
            $root = $doc->documentElement;
        }

        //extrai os dados da tag para uma string
        $dados = $node->C14N(false, false, NULL, NULL);

        //calcular o hash dos dados
        $hashValue = hash('sha1', $dados, true);

        //converte o valor para base64 para serem colocados no xml
        $digValue = base64_encode($hashValue);

        //monta a tag da assinatura digital
        $signature = $doc->createElementNS(self::$URLdsig, 'Signature');
        $root->appendChild($signature);

        $signedInfo = $doc->createElementNS(self::$URLdsig, 'SignedInfo');
        $signature->appendChild($signedInfo);

        //Cannocalization
        $canonicalizationMethod = $doc->createElementNS(self::$URLdsig, 'CanonicalizationMethod');
        $signedInfo->appendChild($canonicalizationMethod);

        $canonicalizationMethod->setAttribute('Algorithm', self::$URLCanonMeth);
        //SignatureMethod
        $canonicalizationMethod = $doc->createElementNS(self::$URLdsig, 'SignatureMethod');
        $signedInfo->appendChild($canonicalizationMethod);
        $canonicalizationMethod->setAttribute('Algorithm', self::$URLSigMeth);

        //Reference
        $reference = $doc->createElementNS(self::$URLdsig, 'Reference');
        $signedInfo->appendChild($reference);
        if(isset($id)) {
            $reference->setAttribute('URI', '#' . $id);
        }

        //Transforms
        $transforms = $doc->createElementNS(self::$URLdsig, 'Transforms');
        $reference->appendChild($transforms);

        //Transform
        $canonicalizationMethod = $doc->createElementNS(self::$URLdsig, 'Transform');
        $transforms->appendChild($canonicalizationMethod);
        $canonicalizationMethod->setAttribute('Algorithm', self::$URLTransfMeth_1);
        //Transform
        $canonicalizationMethod = $doc->createElementNS(self::$URLdsig, 'Transform');
        $transforms->appendChild($canonicalizationMethod);
        $canonicalizationMethod->setAttribute('Algorithm', self::$URLTransfMeth_2);

        //DigestMethod
        $canonicalizationMethod = $doc->createElementNS(self::$URLdsig, 'DigestMethod');
        $reference->appendChild($canonicalizationMethod);
        $canonicalizationMethod->setAttribute('Algorithm', self::$URLDigestMeth);

        //DigestValue
        $canonicalizationMethod = $doc->createElementNS(self::$URLdsig, 'DigestValue',$digValue);
        $reference->appendChild($canonicalizationMethod);

        // extrai os dados a serem assinados para uma string
        $dados = $signedInfo->C14N(false, false, NULL, NULL);

        //inicializa a variável que irá receber a assinatura
        $sign = '';

        //executa a assinatura digital usando o resource da chave privada
        $resp = openssl_sign($dados, $sign, $pkeyid);

        //codifica assinatura para o padrao base64
        $signatureValue = base64_encode($sign);

        //SignatureValue
        $canonicalizationMethod = $doc->createElementNS(self::$URLdsig, 'SignatureValue', $signatureValue);
        $signature->appendChild($canonicalizationMethod);

        //KeyInfo
        $KeyInfo = $doc->createElementNS(self::$URLdsig, 'KeyInfo');
        $signature->appendChild($KeyInfo);

        //X509Data
        $X509Data = $doc->createElementNS(self::$URLdsig, 'X509Data');
        $KeyInfo->appendChild($X509Data);
        
        //carrega o certificado sem as tags de inicio e fim
        $cert = self::cleanCert($chave);
        
        //X509Certificate
        $canonicalizationMethod = $doc->createElementNS(self::$URLdsig, 'X509Certificate', $cert);
        $X509Data->appendChild($canonicalizationMethod);
        
        // libera a memoria
        openssl_free_key($pkeyid);
        
        //retorna o documento assinado
        return $doc;
    }

    /**
     * Pega somente a parte do certificado do arquivo PEM
     * 
     * @param $certFile
     * @author Eric Maicon
     */
    protected static function cleanCert($certFile) {
        //carregar a chave publica do arquivo pem
        $pubKey = file_get_contents($certFile);
        $data = end(explode('-----BEGIN CERTIFICATE-----', $pubKey));
        $data = trim(str_replace('-----END CERTIFICATE-----', '', $data));

        return $data;
    }
}