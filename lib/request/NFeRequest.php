<?php

namespace request;

/**
 * Histórico de alterações:
 * {dd/mm/yyyy} {autor} {descrição}
 * 
 **/

/**
 * Model para ser extendido pelos outros models, para tratar alguma regra específica
 * 
 * @class NFeRequest
 * @version <1.0.0>
 * @date 08/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
abstract class NFeRequest {

    public $xsd;
    public $versao;
    public $UF;
    public $servico;
}