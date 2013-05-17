<?php

/**
 * @link
 * @copyright
 * @license
 */

namespace nfe\envio;

/**
 * @Função: serviço destinado à recepção de mensagens de lote de NF-e.
 * @Processo: assíncrono.
 * @Método: nfeRecepcaoLote2
 * @Entrada: Estrutura XML com as notas fiscais enviadas.
 * @Retorno: Estrutura XML com a mensagem do resultado da transmissão.
 * 
 * @author Eric Maicon <eric@ericmaicon.com.br>
 * @since 1.0
 */
class Document extends \nfe\base\Document {

    private $versao;
    private $idLote;

    /**
     * @param 
     * @throws
     */
    public function __construct() {
        parent::__construct("nfeRecepcaoLote2");
    }

    /**
     * 
     * Schema XML: enviNFe_v2.00.xsd
     * 
     * Este método será responsável por receber as mensagens de envio de lotes de NF-e e colocá-las na fila de entrada.
     * 
     * Não existindo qualquer problema nas validações acima referidas, o aplicativo deverá gerar um número de recibo (vide item 5.5) e gravar a mensagem, juntamente com o número do recibo e o CNPJ do transmissor.
     * 
     * Após a gravação da mensagem na fila de entrada será retornada uma mensagem de confirmação de recebimento para o transmissor, com as seguintes informações:
     * a identificação do ambiente;
     * a versão do aplicativo;
     * o código 103 e o literal “Lote recebido com Sucesso”;
     * o código da UF que atendeu a solicitação;
     * o número do recibo (vide item 5.5), com data, hora local de recebimento da mensagem;
     * tempo médio de resposta do serviço de processamento dos lotes nos últimos 5 minutos (vide detalhamento da forma de cálculo no item 5.7).
     * 
     * Caso ocorra algum problema de validação, o aplicativo deverá retornar uma mensagem com as seguintes informações:
     * 
     * a identificação do ambiente;
     * a versão do aplicativo;
     * o código e a respectiva mensagem de erro (vide a tabela do item 5.1.1);
     * 
     * @param EnvNFe $envNfe
     * @return void
     * @throws 
     */
    public function enviNFe($envNfe) {
        $content = <<<EOF
<enviNFe versao="{$envNfe->getVersao()}" xmlns="http://www.portalfiscal.inf.br/nfe" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.portalfiscal.inf.br/nfe enviNFe_v2.00.xsd">
  <idLote>{$envNfe->getIdLote()}</idLote>
  <NFe>
    <infNFe Id="{$envNfe->getNFe()->getInfNFe()}" versao="">
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
        <ds:CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
        <ds:SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1"/>
        <ds:Reference URI="http://tempuri.org">
          <ds:Transforms>
            <ds:Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/>
            <ds:Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/>
          </ds:Transforms>
          <ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1"/>
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

        return $content;
    }

}
