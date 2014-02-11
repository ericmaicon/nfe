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
     * Método que retorna o XML Pronto
     * 
     * @author Eric Maicon
     */
    public function getXml() {
        $this->xml = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<enviNFe versao="{$this->request->versao}" xmlns="http://www.portalfiscal.inf.br/nfe"
    xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.portalfiscal.inf.br/nfe {$this->request->xsd} ">
    <idLote>{$this->request->idLote}</idLote>
    <NFe>
        <infNFe Id="{$this->request->Id}" versao="{$this->request->versao}">
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
    </NFe>
</enviNFe>
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
        return <<<EOF
<?xml version="1.0" encoding="utf-8"?>
<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Header>
    <nfeCabecMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/NfeRecepcao2">
      <cUF>string</cUF>
      <versaoDados>string</versaoDados>
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

}