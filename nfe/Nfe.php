<?php

/**
 * Nfe file.
 *
 * @link
 * @copyright
 * @license
 */
require(__DIR__ . '/NfeBase.php');

/**
 * @author Eric Maicon <eric@ericmaicon.com.br>
 * @since 1.0
 */
class Nfe extends \nfe\NfeBase {
    
}

spl_autoload_register(array('Nfe', 'autoload'));