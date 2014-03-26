<?php

namespace metodos;

/**
 * Histórico de alterações:
 * {dd/mm/yyyy} {autor} {descrição}
 * 
 **/

/**
 * Classe que consome o webservice NFeRecepcao
 * 
 * @class NFeRecepcao
 * @version <1.0.0>
 * @date 10/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class NFeRecepcao extends \metodos\NFeMetodo {

    /**
     * Sobreescrita do construtor para setar as variáveis
     * 
     * @param $request
     * @author Eric Maicon
     */
    public function __construct($request = null) {
        $this->versao = '2.00';
        $this->xsd = 'enviNFe_v2.00.xsd';
        $this->servico = 'NfeRecepcao';
        $this->tagToSign = 'infNFe';

        parent::__construct($request);
    }

    /**
     * Método que retorna o XML Pronto
     * 
     * @author Eric Maicon
     */
    public function getXml() {
        if(!isset($this->request->NFe->infNFe->Id)) {
            $arrayIdCalculado = self::calcularId($this->request);
            $this->request->NFe->infNFe->Id = $arrayIdCalculado['Id'];
            $this->request->NFe->infNFe->ide->cDV = $arrayIdCalculado['cDV'];
        }

        $this->xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><enviNFe versao=\"{$this->versao}\" xmlns=\"http://www.portalfiscal.inf.br/nfe\">";
        $this->xml .= \helpers\ObjectHelper::objectToStringXml($this->request);
        $this->xml .= "</enviNFe>";

        //TODO: melhorar
        $this->xml = str_replace("<infNFe>", "<infNFe Id=\"{$this->request->NFe->infNFe->Id}\" versao=\"{$this->versao}\">", $this->xml);
        $this->xml = preg_replace('~\<Id\>.{47}\</Id\>~', "", $this->xml);

        preg_match_all("~<det[1-9]>~", $this->xml, $out, PREG_PATTERN_ORDER);

        $i=1;
        foreach($out[0] as $name => $value) {
            $this->xml = str_replace($value, "<det nItem=\"" . $i . "\">", $this->xml);
            $this->xml = str_replace("</det" . $i . ">", "</det>", $this->xml);
            $i++;
        }

        echo $this->xml;
        exit;

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
<enviNFe versao="" xmlns="http://www.portalfiscal.inf.br/nfe"
    xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.portalfiscal.inf.br/nfe enviNFe_v2.00.xsd ">
    <idLote>idLote</idLote>
    <NFe>
        <infNFe Id="" versao="">
            <ide>
                <cUF>11</cUF>
                <cNF>cNF</cNF>
                <natOp>natOp</natOp>
                <indPag>0</indPag>
                <mod>55</mod>
                <serie>serie</serie>
                <nNF>nNF</nNF>
                <dEmi>dEmi</dEmi>
                <tpNF>0</tpNF>
                <cMunFG>cMunFG</cMunFG>
                <tpImp>1</tpImp>
                <tpEmis>1</tpEmis>
                <cDV>cDV</cDV>
                <tpAmb>1</tpAmb>
                <finNFe>1</finNFe>
                <procEmi>0</procEmi>
                <verProc>verProc</verProc>
            </ide>
            <emit>
                <CNPJ>CNPJ</CNPJ>
                <xNome>xNome</xNome>
                <enderEmit>
                    <xLgr>xLgr</xLgr>
                    <nro>nro</nro>
                    <xBairro>xBairro</xBairro>
                    <cMun>cMun</cMun>
                    <xMun>xMun</xMun>
                    <UF>AC</UF>
                    <CEP>CEP</CEP>
                </enderEmit>
                <IE>IE</IE>
                <CRT>1</CRT>
            </emit>
            <dest>
                <CNPJ>CNPJ</CNPJ>
                <xNome>xNome</xNome>
                <enderDest>
                    <xLgr>xLgr</xLgr>
                    <nro>nro</nro>
                    <xBairro>xBairro</xBairro>
                    <cMun>cMun</cMun>
                    <xMun>xMun</xMun>
                    <UF>AC</UF>
                </enderDest>
                <IE>IE</IE>
            </dest>
            <det nItem="">
                <prod>
                    <cProd>cProd</cProd>
                    <cEAN>cEAN</cEAN>
                    <xProd>xProd</xProd>
                    <NCM>NCM</NCM>
                    <CFOP>1101</CFOP>
                    <uCom>uCom</uCom>
                    <qCom>qCom</qCom>
                    <vUnCom>vUnCom</vUnCom>
                    <vProd>vProd</vProd>
                    <cEANTrib>cEANTrib</cEANTrib>
                    <uTrib>uTrib</uTrib>
                    <qTrib>qTrib</qTrib>
                    <vUnTrib>vUnTrib</vUnTrib>
                    <indTot>0</indTot>
                </prod>
                <imposto>
                    <PIS>
                        <PISAliq>
                            <CST>01</CST>
                            <vBC>vBC</vBC>
                            <pPIS>pPIS</pPIS>
                            <vPIS>vPIS</vPIS>
                        </PISAliq>
                    </PIS>
                    <COFINS>
                        <COFINSAliq>
                            <CST>01</CST>
                            <vBC>vBC</vBC>
                            <pCOFINS>pCOFINS</pCOFINS>
                            <vCOFINS>vCOFINS</vCOFINS>
                        </COFINSAliq>
                    </COFINS>
                </imposto>
            </det>
            <total>
                <ICMSTot>
                    <vBC>vBC</vBC>
                    <vICMS>vICMS</vICMS>
                    <vBCST>vBCST</vBCST>
                    <vST>vST</vST>
                    <vProd>vProd</vProd>
                    <vFrete>vFrete</vFrete>
                    <vSeg>vSeg</vSeg>
                    <vDesc>vDesc</vDesc>
                    <vII>vII</vII>
                    <vIPI>vIPI</vIPI>
                    <vPIS>vPIS</vPIS>
                    <vCOFINS>vCOFINS</vCOFINS>
                    <vOutro>vOutro</vOutro>
                    <vNF>vNF</vNF>
                </ICMSTot>
            </total>
            <transp>
                <modFrete>0</modFrete>
            </transp>
        </infNFe>
        <ds:Signature>
            <ds:SignedInfo>
                <ds:CanonicalizationMethod
                    Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" />
                <ds:SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1" />
                <ds:Reference URI="http://tempuri.org">
                    <ds:Transforms>
                        <ds:Transform
                            Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature" />
                        <ds:Transform
                            Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature" />
                    </ds:Transforms>
                    <ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1" />
                    <ds:DigestValue>MA==</ds:DigestValue>
                </ds:Reference>
            </ds:SignedInfo>
            <ds:SignatureValue>MA==</ds:SignatureValue>
            <ds:KeyInfo>
                <ds:X509Data>
                    <ds:X509Certificate>MA==</ds:X509Certificate>
                </ds:X509Data>
            </ds:KeyInfo>
        </ds:Signature>
    </NFe>
</enviNFe>
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
    <nfeCabecMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/NfeRecepcao2">
      <cUF>{$uf}</cUF>
      <versaoDados>{$this->versao}</versaoDados>
    </nfeCabecMsg>
  </soap12:Header>
  <soap12:Body>
    <nfeDadosMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/NfeRecepcao2">
    {$xml}
    </nfeDadosMsg>
  </soap12:Body>
</soap12:Envelope>
EOF;
    }

    /**
     * Método que retorna o Id
     * no Manual: 5.4 Chave de Acesso da NF-e
     * 
     * @author Eric Maicon
     */
    public static function calcularId($request) {
        $cUF = $request->NFe->infNFe->ide->cUF;
        $dEmi = date("ym", strtotime($request->NFe->infNFe->ide->dEmi));
        $cnpj = $request->NFe->infNFe->emit->CNPJ;
        $mod = $request->NFe->infNFe->ide->mod;
        $serie = str_pad($request->NFe->infNFe->ide->serie, 3, 0, STR_PAD_LEFT);
        $nNF = $request->NFe->infNFe->ide->nNF;
        $tpEmis = $request->NFe->infNFe->ide->tpEmis;
        $cNF = $request->NFe->infNFe->ide->cNF;

        if(strlen($cUF) != 2) {
            throw new \exceptions\InvalidIdParamException("o UF (cUF) deve ter 2 dígitos");
        }

        if(strlen($dEmi) != 4) {
            throw new \exceptions\InvalidIdParamException("A data de emissão (dEmi) está inválida");
        }

        if(strlen($cnpj) != 14) {
            throw new \exceptions\InvalidIdParamException("O CNPJ (cnpj) deve ter 14 dígitos");
        }

        if(strlen($mod) != 2) {
            throw new \exceptions\InvalidIdParamException("O modelo (mod) deve ter 2 dígitos");
        }

        if(strlen($serie) != 3) {
            throw new \exceptions\InvalidIdParamException("A série (serie) deve ter 3 dígitos");
        }

        if(strlen($nNF) != 9) {
            throw new \exceptions\InvalidIdParamException("O número da nota (nNF) deve ter 9 dígitos");
        }

        if(strlen($tpEmis) != 1) {
            throw new \exceptions\InvalidIdParamException("A Forma de Emissão (tpEmis) deve ter 1 dígito");
        }

        if(strlen($cNF) != 8) {
            throw new \exceptions\InvalidIdParamException("O código númerico (cNF) deve ter 8 dígitos");
        }

        $retorno = 'NFe';
        $retorno .= $cUF;
        $retorno .= $dEmi;
        $retorno .= $cnpj;
        $retorno .= $mod;
        $retorno .= $serie;
        $retorno .= $nNF;
        $retorno .= $tpEmis;
        $retorno .= $cNF;

        $cDV = self::calcularDigitoVerificador($retorno);
        $retorno .= $cDV;

        return array(
            'Id' => $retorno,
            'cDV' => $cDV,
        );
    }

    /**
     * O dígito verificador da chave de acesso da NF-e é baseado em um cálculo do módulo 11.
     * O módulo 11 de um número é calculado multiplicando-se cada algarismo pela sequência de multiplicadores 2,3,4,5,6,7,8,9,2,3, ... posicionados da direita para a esquerda.
     * A somatória dos resultados das ponderações dos algarismos é dividida por 11 e o DV (dígito verificador) será a diferença entre o divisor (11) e o resto da divisão:
     * http://www.rafaeltheodoro.com.br/tag/digito-verificador/
     *
     * @param $chave
     * @author Eric Maicon
     */
    public static function calcularDigitoVerificador($chave) {
        $base = 9;
        $result = 0;
        $sum = 0;
        $factor = 2;
         
        for($i = strlen($chave); $i > 0; $i--) {
            $numbers[$i] = substr($chave,$i-1,1);
            $partial[$i] = $numbers[$i] * $factor;
            $sum += $partial[$i];
            
            if($factor == $base) {
                $factor = 1;
            }
         
            $factor++;
        }
         
        if($result == 0) {
            $sum *= 10;
            $digit = $sum % 11;
            if($digit == 10) {
                $digit = 0;
            }
        
            return $digit;
        } elseif($result == 1) {
            $rest = $sum % 11;
            return $rest;
        }
    }
}