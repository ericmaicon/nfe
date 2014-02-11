<?php

namespace request;

/**
 * Histórico de alterações:
 * {dd/mm/yyyy} {autor} {descrição}
 * 
 **/

/**
 * Model com todos os campos para consumir o método de consulta de cadastro
 * 
 * TODO: mudar de public pra private (get e set)
 *
 * @class NFeConsultaCadastroRequest
 * @version <1.0.0>
 * @date 08/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class NFeConsultaCadastroRequest extends \request\NFeRequest {

    public $xServ;
    public $IE;

    /**
     * Método que define o xsd padrão, caso não seja enviado
     * 
     * @author Eric Maicon
     */
    public function __construct() {
        $this->versao = '2.00';
        $this->xsd = 'consCad_v2.00.xsd';
        $this->servico = 'NfeConsultaCadastro';
    }
}