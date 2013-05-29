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

    private $envNFe;

    /**
     * @param 
     * @throws
     */
    public function __construct() {
        parent::__construct("nfeRecepcaoLote2");
    }

    /**
     * @param 
     * @return void
     * @throws 
     */
    public function setEnvNFe($envNFe) {
        $this->envNFe = $envNFe;

        return $this;
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
     * @param 
     * @return String xml
     * @throws 
     */
    public function body() {

        $content = $this->recursiveContent($this->envNFe['NFe']);

        var_dump($content);
        exit;

        $xml = <<<EOF
<enviNFe versao="{$this->envNFe['versao']}" xmlns="http://www.portalfiscal.inf.br/nfe" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.portalfiscal.inf.br/nfe enviNFe_v2.00.xsd"><idLote>{$this->envNFe['idLote']}</idLote><NFe>{$content}</NFe></enviNFe>
EOF;

        return $xml;
    }

    /**
     * 
     * @param 
     * @return String xml
     * @throws 
     */
    private function recursiveContent($content) {
        $returnContent = '';

        foreach ($content as $array => $value) {
            if (is_array($value)) {
                $returnContent .= $this->recursiveContent($value);
            } else {
                return "<{$array}>{$value}</{$array}>";
            }
        }

        return $returnContent;
    }

}
