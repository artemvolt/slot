<?php

namespace Slotegrator\Core\Entities\Gifts;

use Slotegrator\Core\Entities\BonusPoint\BonusPoints;

/**
 * class GiftBonusPoints
 */
class GiftBonusPoints implements Gift
{
    private BonusPoints $points;

    public function __construct(BonusPoints $points)
    {
        $this->points = $points;
    }

    public function name(): string
    {
        return $this->points->name();
    }

    public function value(): string
    {
        return $this->points->value();
    }
}