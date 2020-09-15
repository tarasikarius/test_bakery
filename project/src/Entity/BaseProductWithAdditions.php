<?php

namespace src\Entity;

use src\Exception\ProductNotCompleteException;

abstract class BaseProductWithAdditions extends BaseProduct
{
    protected $additions = [];

    abstract public function getAllowedOptionalIngredients(): array;

    public function setAdditions(array $additions)
    {
        $allowedAdditions = $this->getAllowedOptionalIngredients();

        foreach ($additions as $addition) {
            if (!isset($allowedAdditions[$addition])) {
                throw new ProductNotCompleteException(sprintf('Ingredient %s is not used in this recipe', $addition));
            }

            $this->additions[$addition] = $allowedAdditions[$addition];
        }
    }

    public function getFinalRecipe()
    {
        return array_merge($this->getReceiptIngredients(), $this->additions);
    }

    public function mixIngredients(): void
    {
        $this->mix($this->getFinalRecipe());
    }

    public function isCompleted(): bool
    {
        $ingredients = $this->getIngredients();

        foreach ($this->getFinalRecipe() as $ingredientName => $className) {
            if (!isset($ingredients[$ingredientName]) || get_class($ingredients[$ingredientName]) !== $className) {
                return false;
            }
        }

        return true;
    }
}
