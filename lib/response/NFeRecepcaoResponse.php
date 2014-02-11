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
 * @class NFeRecepcaoResponse
 * @version <1.0.0>
 * @date 10/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class NFeRecepcaoResponse extends \request\NFeRequest {

    public $verAplic;
    public $cStat;
    public $xMotivo;
    public $UF;
    public $dhCons;
    public $cUF;
}