<?php

namespace Slotegrator\Core\Components;

/**
 * class Collection
 */
class Collection
{
    protected array $items = [];

    public function __construct(array $items = []) {
        $this->items = $items;
    }

    /**
     * @return mixed
     */
    public function rand():mixed {
        $randIndex = array_rand($this->items);
        return $this->items[$randIndex];
    }
}