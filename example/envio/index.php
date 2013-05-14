<?php

$frameworkPath = __DIR__ . '/../../nfe';
require($frameworkPath . '/Nfe.php');

$nota = new nfe\envio\Document();
$nota->withCabecalho()
        ->build();

var_dump($nota->toXml());