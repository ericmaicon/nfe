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
class Municipio {

    /**
     * 
     * Os campos de códigos de municípios devem ser informados com a utilização da Tabela de código de Município mantida pelo IBGE disponível em:
     * ftp://geoftp.ibge.gov.br/Organizacao/Divisao_Territorial/2008/DTB_2008.zip
     * 
     * @param 
     * @return Numeric
     * @throws
     */
    public function getCodigoMunicipio() {
        
    }

    /**
     * 
     * O Código de Município do IBGE tem a composição que segue:
     * Composição: UUNNNND
     * Onde:
     *  UU = Código da UF do IBGE
     *  NNNN = Número de ordem dentro da UF
     *  D = Dígito de Controle módulo 10
     * 
     * @param 
     * @return Boolean
     * @throws
     */
    public function isCodigoMunicipioValido() {
        
    }

}