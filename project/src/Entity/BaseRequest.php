<?php

namespace src\Entity;

use src\Exception\OrderWithoutArgumentsException;

class BaseRequest
{
    /** @var string */
    protected $productName;

    /** @var array  */
    protected $additions = [];

    public static function createFromArguments(array $argv): BaseRequest
    {
        array_shift($argv);
        if (empty($argv)) {
            throw new OrderWithoutArgumentsException();
        }

        $request = new BaseRequest();
        $request->setProductName($argv[0]);
        $request->setAdditions($argv);

        return $request;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductName(string $productName)
    {
        $this->productName = $productName;
    }

    public function getAdditions(): array
    {
        return $this->additions;
    }

    public function setAdditions(array $argv): void
    {
        foreach ($argv as $arg) {
            if (false === strpos($arg, '--')) {
                continue;
            }

            $this->additions[] = ltrim($arg, '--');
        }
    }
}
