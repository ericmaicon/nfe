<?php

/**
 * 
 * @link
 * @copyright
 * @license
 */

namespace nfe\localizacao;

/**
 * @author Eric Maicon <eric@ericmaicon.com.br>
 * @since 1.0
 */
class Pais {

    /**
     * 
     * Para o preenchimento dos campos de códigos de países deve ser utilizada a Tabela de País do Banco Central do Brasil, disponível em:
     * http://www.bcb.gov.br/Rex/TabPaises/Ftp/paises.txt
     * 
     * @param 
     * @return Numeric
     * @throws
     */
    public function getCodigoEstado() {
        
    }

    /**
     * 
     * Composição do Código de País:
     * NNND
     * Onde:
     *  NNN = Número de ordem do Código do País;
     *  D = Dígito de Controle módulo 11.
     * 
     * @param 
     * @return Boolean
     * @throws
     */
    public function isCodigoMunicipioValido() {
        
    }

}