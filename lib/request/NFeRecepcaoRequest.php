<?php

namespace request;

/**
 * Histórico de alterações:
 * {dd/mm/yyyy} {autor} {descrição}
 * 
 **/

/**
 * Model com todos os campos para consumir o método de emissão de NFe
 * 
 * TODO: mudar de public pra private (get e set)
 *
 * @class NFeRecepcaoRequest
 * @version <1.0.0>
 * @date 08/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class NFeRecepcaoRequest extends \request\NFeRequest {

    public $idLote;
    public $Id;

    /**
     * Método que define o xsd padrão, caso não seja enviado
     * 
     * @author Eric Maicon
     */
    public function __construct() {
        $this->versao = '2.00';
        $this->xsd = 'enviNFe_v2.00.xsd';
        $this->servico = 'NfeRecepcao2';
    }
}