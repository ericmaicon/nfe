<?php

define('BASE_PATH', realpath(dirname(__FILE__)));

/**
 * Histórico de alterações:
 * {dd/mm/yyyy} {autor} {descrição}
 * 
 **/

/**
 * Classe inicial da biblioteca
 * 
 * @class NFe
 * @version <1.0.0>
 * @date 08/02/2014
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class NFe {

    private static $confFile;

    /**
     * Método que faz o autoload das classes utilizadas
     * 
     * @param $className
     * @throws FileNotFoundException
     * @author Eric Maicon
     */
    public static function autoload($className) {
        $filename = BASE_PATH . '/' . str_replace('\\', '/', $className) . '.php';
        if(is_file($filename)) {
            require($filename);
        } else {
            throw new \exceptions\FileNotFoundException();
        }
    }

    /**
     * Método que carrega as configurações do arquivo
     * 
     * @param $confFile
     * @throws
     * @author Eric Maicon
     */
    public static function configure($confFile) {
        self::$confFile = parse_ini_file($confFile, true);
    }

    /**
     * Pega alguma configuração
     * 
     * @param $confGroup
     * @param $confName
     * @throws
     * @author Eric Maicon
     */
    public static function get($confGroup, $confName) {
        if(!isset(self::$confFile)) {
            throw new \exceptions\ConfigurationFaultException("Você não chamou a classe de configuração passando o arquivo .INI (Ex.: NFe::configure($configFile);)");
        }

        return self::$confFile[$confGroup][$confName];
    }
}

/**
 * Fazendo o carregamento automático das classes. 
 * Ele lê NFe::autoload
 * 
 * @author Eric Maicon
 */
spl_autoload_register(array('NFe', 'autoload'));