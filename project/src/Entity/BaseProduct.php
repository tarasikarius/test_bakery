<?php

namespace src\Entity;

abstract class BaseProduct
{
    const NAME_PANCAKE = 'pancake';
    const NAME_AMERICANO = 'americano';

    /** @var array */
    protected $ingredients = [];

    /**
     * @return string
     */
    abstract public function getName(): string;

    /**
     * @return array
     */
    abstract public function getReceiptIngredients(): array;

    /**
     * @return bool
     */
    public function isCompleted(): bool
    {
        if (count($this->getReceiptIngredients()) !== count($this->ingredients)) {
            return false;
        }

        foreach ($this->getReceiptIngredients() as $ingredientName => $className) {
            if (!isset($this->getIngredients()[$ingredientName]) || get_class($this->getIngredients()[$ingredientName]) !== $className) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return array
     */
    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    public function mixIngredients(): void
    {
        $this->mix($this->getReceiptIngredients());
    }

    protected function mix(array $ingredients)
    {
        foreach ($ingredients as $name => $class) {
            if (isset($this->ingredients[$name])) {
                continue;
            }

            $this->ingredients[$name] = new $class();
        }
    }
}
