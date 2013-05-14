<?php

/**
 * @link
 * @copyright
 * @license
 */

namespace nfe\base;

use Nfe;

/**
 * @author Eric Maicon <eric@ericmaicon.com.br>
 * @since 1.0
 */
abstract class Document extends Component {

    private $xml = '';
    private $cabecalho = false;

    /**
     * @param 
     * @return
     * @throws
     */
    public function __construct() {
        Nfe::$app = $this;
    }

    public function withCabecalho() {
        $this->cabecalho = true;

        return $this;
    }

    protected function cabecalho() {
        $content = <<<EOF
<NFe xmlns="http://www.portalfiscal.inf.br/nfe">
EOF;
        
        return $content;
    }

    public function build() {
        $this->xml = '';
        if($this->cabecalho) {
            $this->xml .= $this->cabecalho();
        }
    }

    public function toXml() {
        return $this->xml;
    }

}