<?php

namespace helpers;

/**
 * Histórico de alterações:
 * {dd/mm/yyyy} {autor} {descrição}
 * 
 **/

/**
 * Classe com funções auxiliares para manipulação de arquivos
 * 
 * @class FileHelper
 * @version <1.0.0>
 * @date 10/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class FileHelper {

    /**
     * Método que valida se o file existe ou não
     * 
     * @param $className
     * @throws FileNotFoundException
     * @author Eric Maicon
     */
    public static function valida($fileName) {
        if(is_file($fileName)) {
            return $fileName;
        } else {
            throw new \exceptions\FileNotFoundException("O arquivo " . $fileName . " não foi encontrado.");
        }
    }

}