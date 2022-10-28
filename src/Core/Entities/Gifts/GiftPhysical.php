<?php

namespace Slotegrator\Core\Entities\Gifts;

use Slotegrator\Core\Entities\Physical\Physical;

/**
 * class GiftPhysical
 */
class GiftPhysical implements Gift
{
    private Physical $physical;

    public function __construct(Physical $physical) {
        $this->physical = $physical;
    }

    public function name(): string
    {
        return 'Физический предмет';
    }

    public function value(): string
    {
        return $this->physical->name();
    }
}