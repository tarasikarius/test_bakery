<?php

namespace src\Manufacture\Bakery;

use src\Entity\BaseProduct;
use src\Entity\BaseRequest;
use src\Entity\Product\Americano;
use src\Entity\Product\Pancake;
use src\Exception\ProductNotCompleteException;
use src\Exception\ProductNotFoundException;
use src\Manufacture\ManufactureInterface;

class Bakery implements ManufactureInterface
{
    public const PRODUCTS = [
        BaseProduct::NAME_PANCAKE => Pancake::class,
        BaseProduct::NAME_AMERICANO => Americano::class,
    ];

    public function produce(BaseRequest $request)
    {
        $product = $this->getProductFromRequest($request);
        $product->mixIngredients();

        if (!$product->isCompleted()) {
            throw new ProductNotCompleteException('Bakery facing technical difficulties at the moment!');
        }

        return $product;
    }

    public function getProductFromRequest(BaseRequest $request): BaseProduct
    {
        $name = $request->getProductName();
        $productClass = self::PRODUCTS[$name] ?? null;
        if (null === $productClass) {
            throw new ProductNotFoundException($name);
        }
        $product = new $productClass();

        if (method_exists($product, 'setAdditions')) {
            $product->setAdditions($request->getAdditions());
        }

        return $product;
    }
}
