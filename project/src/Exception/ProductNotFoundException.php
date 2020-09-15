<?php

namespace src\Exception;

use src\Manufacture\Bakery\Bakery;
use Throwable;

class ProductNotFoundException extends \Exception
{
    public function __construct($productName, $message = "", $code = 0, Throwable $previous = null)
    {
        if (empty($message)) {

            $options = implode(', ', array_keys(Bakery::PRODUCTS));
            $message = sprintf('We dont have %s in our menu, please try one of these options: %s', $productName, $options);
        }

        parent::__construct($message, $code, $previous);
    }
}
