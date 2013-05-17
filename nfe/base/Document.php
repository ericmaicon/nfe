<?php

/**
 * Pelo documento:
 * A especificação do documento XML adotada é a recomendação W3C para XML 1.0, disponível em www.w3.org/TR/REC-xml e a codificação dos caracteres será em UTF-8, assim todos os documentos XML serão iniciados com a seguinte declaração:
 * 
 * A declaração de namespace da NF-e deverá ser realizada no elemento raiz de cada documento XML como segue:
 * <NFe xmlns=”http://www.portalfiscal.inf.br/nfe” > (exemplo para o XML da NF-e)
 * 
 * Regras:
 * não incluir "zeros não significativos" para campos numéricos;
 * não incluir "espaços" no início ou no final de campos numéricos e alfanuméricos;
 * não incluir comentários no arquivo XML;
 * não incluir anotação e documentação no arquivo XML (TAG annotation e TAG documentation);
 * não incluir caracteres de formatação no arquivo XML ("line-feed", "carriage return", "tab", caractere de "espaço" entre as TAGs).
 * 
 * O modelo de comunicação segue o padrão de Web Services definido pelo WS-I Basic Profile.
 * 
 * A relação dos Web Services em operação está disponível no Portal Nacional:
 * WS de Homologação: http://hom.nfe.fazenda.gov.br/PORTAL/WebServices.aspx
 * WS de Produção: http://www.nfe.fazenda.gov.br/portal/WebServices.aspx
 * 
 * @link
 * @copyright
 * @license
 */

namespace nfe\base;

use Nfe;

/**
 * @author Eric Maicon <eric@ericmaicon.com.br>
 * @since 1.0
 */
abstract class Document extends Component {

    private $xml = '';
    private $cabecalho = false;
    private $versaoDados;
    private $metodo;

    /**
     * @param 
     * @throws
     */
    public function __construct($metodo) {
        Nfe::$app = $this;
        $this->metodo = $metodo;
    }

    /**
     * @param 
     * @return void
     * @throws 
     */
    public function withCabecalho() {
        $this->cabecalho = true;

        return $this;
    }

    /**
     * SOAP versão 1.2, com troca de mensagens XML no padrão Style/Enconding: Document/Literal
     * 
     * A chamada de diferentes Web Services é realizada com o envio de uma mensagem XML através do parâmetro nfeDadosMsg.
     * 
     * A versão do leiaute da mensagem XML contida no parâmetro nfeDadosMsg será informada no elemento versaoDados do tipo string localizado no elemento nfeCabecMsg do SOAP Header.
     * 
     * Exemplo: 
     * <?xml version="1.0" encoding="utf-8"?>
     * <soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
     *                  xmlns:xsd="http://www.w3.org/2001/XMLSchema"
     *                  xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
     *  <soap12:Header>
     *      <nfeCabecMsg xmlns="http://www.portalfiscal.inf.br/sce/wsdl/NfeRecepcao2">
     *          <versaoDados>string</versaoDados>
     *      </nfeCabecMsg>
     *  </soap12:Header>
     *  <soap12:Body>
     *      <nfeRecepcao xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/NfeRecepcao2">
     *          <nfeDadosMsg>xml</nfeDadosMsg>
     *      </nfeRecepcao>
     *  </soap12:Body>
     * </soap12:Envelope>
     * 
     * @param 
     * @return String
     * @throws RequestedNotSatisfiableException
     */
    private function encapsula() {
        if (!isset($this->versaoDados)) {
            throw new RequestedNotSatisfiableException("Está faltando a versão de dados.");
        }

        if (!isset($this->xml)) {
            throw new RequestedNotSatisfiableException("Está faltando o XML.");
        }

        $content = <<<EOF
<?xml version="1.0" encoding="UTF-8"?><soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope"><soap12:Header><nfeCabecMsg xmlns="http://www.portalfiscal.inf.br/sce/wsdl/NfeRecepcao2"><versaoDados>{$this->versaoDados}</versaoDados></nfeCabecMsg></soap12:Header><soap12:Body><nfeRecepcao xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/NfeRecepcao2"><nfeDadosMsg>{$this->xml}</nfeDadosMsg></nfeRecepcao></soap12:Body></soap12:Envelope>
EOF;

        return $content;
    }

    /**
     * 
     * @param 
     * @return String
     * @throws
     */
    private function cabecalho() {
        $content = <<<EOF
<NFe xmlns="http://www.portalfiscal.inf.br/nfe">
EOF;

        return $content;
    }

    /**
     * 
     * Visando facilitar o processo de guarda dos arquivos pelos legítimos interessados, foi criado um padrão de nome para os diversos tipos de arquivos utilizados pelo sistema NF-e. São eles:
     * 
     * NF-e: O nome do arquivo será a chave de acesso completa com extensão “- nfe.xml”;
     * Envio de Lote de NF-e: O nome do arquivo será o número do lote com extensão “- env-lot.xml”;
     * Recibo: O nome do arquivo será o número do lote com extensão “-rec.xml”;
     * Pedido do Resultado do Processamento do Lote de NF-e: O nome do arquivo será o número do recibo com extensão “-ped-rec.xml”;
     * Resultado do Processamento do Lote de NF-e: O nome do arquivo será o número do recibo com extensão “-pro-rec.xml”;
     * Denegação de Uso: O nome do arquivo será a chave de acesso completa com extensão “-den.xml”;
     * Pedido de Cancelamento de NF-e: O nome do arquivo será a chave de acesso completa com extensão “-ped-can.xml”;
     * Cancelamento de NF-e: O nome do arquivo será a chave de acesso completa com extensão “-can.xml”;
     * Pedido de Inutilização de Numeração: O nome do arquivo será composto por: UF + Ano de inutilização + CNPJ do emitente + Modelo + Série + Número Inicial + Número Final com extensão “-ped-inu.xml”;
     * Inutilização de Numeração: O nome do arquivo será composto por: Ano de inutilização + CNPJ do emitente + Modelo + Série + Número Inicial + Número Final com extensão “-inu.xml”;
     * Pedido de Consulta Situação Atual da NF-e: O nome do arquivo será a chave de acesso completa com extensão “-ped-sit.xml”;
     * Situação Atual da NF-e: O nome do arquivo será a chave de acesso completa com extensão “-sit.xml”;
     * Pedido de Consulta do Status do Serviço: O nome do arquivo será: “AAAAMMDDTHHMMSS” do momento da consulta com extensão “-ped-sta.xml”;
     * Status do Serviço: O nome do arquivo será: “AAAAMMDDTHHMMSS” do momento da consulta com extensão “-sta.xml”;
     * 
     * @param 
     * @return String
     * @throws
     */
    public function getNome() {
        
    }

    /**
     * 
     * @param 
     * @return void
     * @throws
     */
    public function build() {
        $this->xml = '';
        if ($this->cabecalho) {
            $this->xml .= $this->cabecalho();
        }
    }

    /**
     * 
     * @param 
     * @return String
     * @throws
     */
    public function toXml() {
        return $this->xml;
    }

}