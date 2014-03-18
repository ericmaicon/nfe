<?php

namespace helpers;

/**
 * Histórico de alterações:
 * {dd/mm/yyyy} {autor} {descrição}
 * 
 **/

/**
 * Classe com funções auxiliares para Objects
 * 
 * @class ObjectHelper
 * @version <1.0.0>
 * @date 18/03/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class ObjectHelper {

    /**
     * Método que converte de object para UMA STRING XML
     *
     * @param $array
     * @author Eric Maicon
     */
    public static function objectToStringXml($object) {
        $xml = "";

        foreach($object as $key => $value) {
            $xml .= '<' . $key . '>';
            if(is_object($value)) {
                $xml .= self::objectToStringXml($value);
            } else {
                $xml .= $value;
            }
            $xml .= '</' . $key . '>';
        }

        return $xml;
    }

}