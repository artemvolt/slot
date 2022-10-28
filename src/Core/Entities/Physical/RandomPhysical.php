<?php

namespace Slotegrator\Core\Entities\Physical;

/**
 * class RandomPhysical
 */
class RandomPhysical implements Physical
{
    private Physical $item;

    public function __construct(PhysicalCollection $items) {
        $this->item = $items->rand();
    }

    public function name(): string
    {
        return $this->item->name();
    }
}