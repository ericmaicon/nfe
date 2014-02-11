<?php

namespace helpers;

/**
 * Histórico de alterações:
 * {dd/mm/yyyy} {autor} {descrição}
 * 
 **/

/**
 * Classe com funções auxiliares para array
 * http://gaarf.info/2009/08/13/xml-string-to-php-array/
 * 
 * @class ArrayHelper
 * @version <1.0.0>
 * @date 10/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class ArrayHelper {

    /**
     * Método que converte xml STRING para Array
     *
     * @param $xml
     * @author Eric Maicon
     */
    public static function xmlToArray($xml) {
        $doc = new \DOMDocument();
        $doc->loadXML($xml);
        return self::domNodeToArray($doc->documentElement);
    }

    /**
     * http://gaarf.info/2009/08/13/xml-string-to-php-array/
     *
     * @param $xml
     * @author Eric Maicon
     */
    public static function domNodeToArray($node) {
        $output = array();
        switch ($node->nodeType) {
            case XML_CDATA_SECTION_NODE:
            case XML_TEXT_NODE:
                $output = trim($node->textContent);
                break;
            case XML_ELEMENT_NODE:
                for ($i=0, $m=$node->childNodes->length; $i<$m; $i++) { 
                    $child = $node->childNodes->item($i);
                    $v = self::domNodeToArray($child);
                    if(isset($child->tagName)) {
                        $t = $child->tagName;
                        if(!isset($output[$t])) {
                            $output[$t] = array();
                        }
                        $output[$t][] = $v;
                    } elseif($v) {
                        $output = (string) $v;
                    }
                }
                
                if(is_array($output)) {
                    if($node->attributes->length) {
                        $a = array();
                    
                        foreach($node->attributes as $attrName => $attrNode) {
                            $a[$attrName] = (string) $attrNode->value;
                        }
                        $output['@attributes'] = $a;
                    }
                    foreach ($output as $t => $v) {
                        if(is_array($v) && count($v)==1 && $t!='@attributes') {
                            $output[$t] = $v[0];
                        }
                    }
                }
                break;
        }
        return $output;
    }

    /**
     * Método que converte de array para Bean
     *
     * @param $array
     * @author Eric Maicon
     */
    public static function arrayToBean($array, $bean) {
        foreach($array as $key => $value) {
            if(is_array($value)) {
                self::arrayToBean($value, $bean);
            } else {
                if(property_exists($bean, $key)) {
                    $bean->$key = $value;
                }
            }
        }
    }

}