<?php

use src\Entity\BaseRequest;
use src\Exception\OrderWithoutArgumentsException;
use src\Exception\ProductNotCompleteException;
use src\Exception\ProductNotFoundException;
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

try {
    $request = BaseRequest::createFromArguments($argv);
    $bakery = new Bakery();
    $product = $bakery->produce($request);
} catch (OrderWithoutArgumentsException $e) {
    exit(sprintf("\n%s\n", $e->getMessage()));
} catch (ProductNotCompleteException | ProductNotFoundException $e) {
    exit(sprintf("\n%s was not completed because of %s\n", $request->getProductName(), lcfirst($e->getMessage())));
}

echo sprintf("\n%s completed!\n", $product->getName());

