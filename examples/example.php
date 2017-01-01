<?php
require __DIR__ . '/../vendor/autoload.php';

use TTF\Computer;
use TTF\mappings\BaseMapping;
use TTF\mappings\Specialized2Mapping;


$parameters = [
    'a' => true,
    'b' => true,
    'c' => false,
    'd' => 1,
    'e' => 200,
    'f' => 1,
];

$computer = new Computer($parameters, new BaseMapping());
$computer->compute();

var_dump($computer->getX(), $computer->getY());

$computer2 = new Computer($parameters, new Specialized2Mapping());
$computer2->compute();

var_dump($computer2->getX(), $computer2->getY());

