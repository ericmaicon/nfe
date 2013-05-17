<?php

/**
 * 
 * @link
 * @copyright
 * @license
 */

namespace nfe\xml;

/**
 * @author Eric Maicon <eric@ericmaicon.com.br>
 * @since 1.0
 */
class Xml {

    /**
     * 
     * Validação Inicial da Mensagem no Web Service
     * 
     * Tamanho do XML de Dados superior a 500 Kbytes
     * XML de Dados Mal Formado
     * 
     * @param 
     * @return Boolean
     * @throws
     */
    public function isXmlValido() {
        
    }

    /**
     * 
     * Os caracteres que afetam o “parser” são:
     * > (sinal de maior)       &lt;
     * < (sinal de menor)       &gt;
     * & (e-comercial)          &amp;
     * “ (aspas)                &quot;
     * ‘ (sinal de apóstrofe)   &#39;
     * 
     * Alguns destes caracteres podem aparecer especialmente no campo de Razão Social, Endereço e Informação Adicional. Para resolver esses casos, é recomendável o uso de uma seqüência de “escape” em substituição ao caractere que causa o problema.
     * 
     * @param 
     * @return void
     * @throws
     */
    public function trataCaracteres() {
        
    }

}