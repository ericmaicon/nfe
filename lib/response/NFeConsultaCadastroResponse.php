<?php

namespace response;

/**
 * Histórico de alterações:
 * {dd/mm/yyyy} {autor} {descrição}
 * 
 **/

/**
 * Model com todos os campos retornados como resposta
 * 
 * TODO: mudar de public pra private (get e set)
 *
 * @class NFeConsultaCadastroResponse
 * @version <1.0.0>
 * @date 10/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class NFeConsultaCadastroResponse extends \request\NFeRequest {

    public $verAplic;
    public $cStat;
    public $xMotivo;
    public $UF;
    public $dhCons;
    public $cUF;
}