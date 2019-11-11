<?php

use src\Manufacture\Bakery\Bakery;

function myAutoLoad($className)
{
    $classPieces = explode("\\", $className);
    switch ($classPieces[0]) {
        case 'src':
            include __DIR__ .'/'. implode(DIRECTORY_SEPARATOR, $classPieces) . '.php';
            break;
    }
}
spl_autoload_register('myAutoLoad', '', true);

$bakery = new Bakery();

// TODO: Implement bakery->produce(BaseRequest $request) method and echo result like '{productName} completed' or '{productName} was not completed because of {failReason}'

