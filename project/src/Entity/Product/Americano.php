<?php

namespace src\Entity\Product;

use src\Entity\BaseIngredient;
use src\Entity\BaseProductWithAdditions;
use src\Entity\Ingredient\Coffee;
use src\Entity\Ingredient\Sugar;
use src\Entity\Ingredient\Water;

class Americano extends BaseProductWithAdditions
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return self::NAME_AMERICANO;
    }

    /**
     * @return array
     */
    public function getReceiptIngredients(): array
    {
        return [
            BaseIngredient::NAME_COFFEE => Coffee::class,
            BaseIngredient::NAME_WATER => Water::class,
        ];
    }

    /**
     * @return array
     */
    public function getAllowedOptionalIngredients(): array
    {
        return [
            BaseIngredient::NAME_SUGAR => Sugar::class,
        ];
    }
}
