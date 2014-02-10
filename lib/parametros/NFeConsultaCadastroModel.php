<?php

namespace parametros;

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
 * @class NFeConsultaCadastroModel
 * @version <1.0.0>
 * @date 08/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class NFeConsultaCadastroModel extends \parametros\NFeModel {

    public $xServ;
    public $UF;
    public $IE;

    /**
     * Método que define o xsd padrão, caso não seja enviado
     * 
     * @throws
     * @author Eric Maicon
     */
    public function __construct() {
        $this->xsd = 'consCad_v2.00.xsd';
    }
}