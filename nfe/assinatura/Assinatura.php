<?php

/**
 * 
 * @link
 * @copyright
 * @license
 */

namespace nfe\assinatura;

/**
 * @author Eric Maicon <eric@ericmaicon.com.br>
 * @since 1.0
 */
class Assinatura {

    /**
     * 
     * O certificado digital utilizado no Projeto Nota Fiscal eletrônica será emitido por Autoridade Certificadora credenciada pela Infraestrutura de Chaves Públicas Brasileira – ICP-Brasil, tipo A1 ou A3, devendo conter o CNPJ da pessoa jurídica titular do certificado digital no campo otherName OID =2.16.76.1.3.3.
     * 
     * A assinatura do Contribuinte na NF-e será feita na TAG <infNFe> identificada pelo atributo Id, cujo conteúdo deverá ser um identificador único (chave de acesso) precedido do literal ‘NFe’ para cada NF-e conforme leiaute descrito no Anexo I. O identificador único precedido do literal ‘#NFe’ deverá ser informado no atributo URI da TAG <Reference>. Para as demais mensagens a serem assinadas, o processo é o mesmo mantendo sempre um identificador único para o atributo Id na TAG a ser assinada. Segue abaixo um exemplo:
     * 
     * Exemplo:
     * <NFe xmlns="http://www.portalfiscal.inf.br/nfe" >
     *  <infNFe Id="NFe31060243816719000108550000000010001234567897" versao="1.01">
     *      ...
     *  </infNFe>
     *  <Signature xmlns="http://www.w3.org/2000/09/xmldsig#">
     *      <SignedInfo>
     *          <CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
     *          <SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1" />
     *          <Reference URI="#NFe31060243816719000108550000000010001234567897">
     *              <Transforms>
     *                  <Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/>
     *                  <Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
     *              </Transforms>
     *              <DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1"/>
     *              <DigestValue>vFL68WETQ+mvj1aJAMDx+oVi928=</DigestValue>
     *          </Reference>
     *      </SignedInfo>
     *      <SignatureValue>IhXNhbdL1F9UGb2ydVc5v/gTB/y6r0KIFaf5evUi1i ...</SignatureValue>
     *      <KeyInfo>
     *          <X509Data>
     *              <X509Certificate>MIIFazCCBFOgAwIBAgIQaHEfNaxSeOEvZGlVDANB ... </X509Certificate>
     *          </X509Data>
     *      </KeyInfo>
     *  </Signature>
     * </NFe>
     * 
     * A assinatura digital do documento eletrônico deverá atender aos seguintes padrões adotados:
     * 
     * a) Padrão de assinatura: “XML Digital Signature”, utilizando o formato “Enveloped” (http://www.w3.org/TR/xmldsig-core/);
     * b) Certificado digital: Emitido por AC credenciada no ICP-Brasil (http://www.w3.org/2000/09/xmldsig#X509Data);
     * c) Cadeia de Certificação: EndCertOnly (Incluir na assinatura apenas o certificado do usuário final);
     * d) Tipodocertificado: A1 ou A3;
     * e) Tamanho da Chave Criptográfica: Compatível com os certificados A1 e A3 (1024bits);
     * f) Função criptográfica assimétrica: RSA (http://www.w3.org/2000/09/xmldsig#rsa-sha1);
     * g) Funçãode“messagedigest”:SHA-1(http://www.w3.org/2000/09/xmldsig#sha1);
     * h) Codificação:Base64(http://www.w3.org/2000/09/xmldsig#base64);
     * i) Transformações exigidas: Útil para realizar a canonicalização do XML enviado para realizar a validação correta da Assinatura Digital. São elas: 
     *  (1) Enveloped (http://www.w3.org/2000/09/xmldsig#enveloped-signature) 
     *  (2) C14N (http://www.w3.org/TR/2001/REC-xml-c14n-20010315)
     * 
     * @param 
     * @return String
     * @throws
     */
    private function assina() {
        
    }

    /**
     * 
     * Para a validação da assinatura digital, seguem as regras que serão adotadas pelas Secretarias de Fazenda Estaduais:
     * 
     * (1) Extrair a chave pública do certificado;
     * (2) Verificar o prazo de validade do certificado utilizado;
     * (3) Montar e validar a cadeia de confiança dos certificados validando também a LCR (Lista de Certificados Revogados) de cada certificado da cadeia;
     * (4) Validar o uso da chave utilizada (Assinatura Digital) de tal forma a aceitar certificados somente do tipo A (não serão aceitos certificados do tipo S);
     * (5) Garantir que o certificado utilizado é de um usuário final e não de uma Autoridade Certificadora;
     * (6) Adotar as regras definidas pelo RFC 3280 para as LCR e cadeia de confiança;
     * (7) Validar a integridade de todas as LCR utilizadas pelo sistema;
     * (8) Prazo de validade de cada LCR utilizada (verificar data inicial e final).
     * 
     * @param 
     * @return Boolean
     * @throws
     */
    public function isCertificadoValido() {
        
    }

}