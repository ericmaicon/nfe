<?php

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

    const LIB_DIR = "lib/";
    const WSDL_DIR = "wsdl/";
    const CERT_DIR = "cert/";
    const XSD_DIR = "xsd/";
    const VENDOR_DIR = "vendor/";

    /**
     * Método que faz o autoload das classes utilizadas
     * 
     * @param $className
     * @throws FileNotFoundException
     * @author Eric Maicon
     */
    public static function autoload($className) {
        $filename = self::getBasePath() . self::LIB_DIR . '/' . str_replace('\\', '/', $className) . '.php';
        if(is_file($filename)) {
            require($filename);
        } else {
            throw new \exceptions\FileNotFoundException("O arquivo " . $className . " não foi encontrado.");
        }
    }

    /**
     * Método inicial, que carrega os ini file, faz o require nos vendors...
     * 
     * @param $confFile
     * @author Eric Maicon
     */
    public static function configure($confFile) {
        self::loadVendors();
        self::parseIniFile($confFile);
    }

    /**
     * Método que faz o require das libs na pasta vendor
     *
     * TODO: Verificar se tem um jeito melhor de fazer isso (dinâmico)
     * 
     * @author Eric Maicon
     */
    private static function loadVendors() {
        require_once(self::getBasePath() . self:: VENDOR_DIR .'/xmlseclibs.php');
    }

    /**
     * Método que carrega as configurações do arquivo
     * 
     * @param $confFile
     * @author Eric Maicon
     */
    private static function parseIniFile($confFile) {
        self::$confFile = parse_ini_file($confFile, true);
    }

    /**
     * Pega alguma configuração
     * 
     * @param $confGroup
     * @param $confName
     * @author Eric Maicon
     */
    public static function get($confGroup, $confName) {
        if(!isset(self::$confFile)) {
            throw new \exceptions\ConfigurationFaultException("Você não chamou a classe de configuração passando o arquivo .INI (Ex.: NFe::configure($configFile);)");
        }

        return self::$confFile[$confGroup][$confName];
    }

    /**
     * Retorna caminho de pastas do sistema
     * 
     * @author Eric Maicon
     */
    public static function getBasePath() {
        return realpath(dirname(__FILE__) . '/../') . '/';
    }
}

/**
 * Fazendo o carregamento automático das classes. 
 * Ele lê NFe::autoload
 * 
 * @author Eric Maicon
 */
spl_autoload_register(array('NFe', 'autoload'));