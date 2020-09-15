<?php

namespace src\Exception;

use src\Manufacture\Bakery\Bakery;
use Throwable;

class OrderWithoutArgumentsException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if (empty($message)) {

            $options = implode(', ', array_keys(Bakery::PRODUCTS));
            $message = sprintf('You didn\'t order anything, please try one of these options: %s', $options);
        }

        parent::__construct($message, $code, $previous);
    }
}
