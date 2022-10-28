<?php

namespace Slotegrator\Core\Entities\BonusPoint;

use Exception;

/**
 * class RandomBonusPointsInRange
 */
class RandomBonusPointsInRange implements BonusPoints
{
    protected int $from;
    protected int $to;

    public function __construct(int $from, int $to) {
        $this->from = $from;
        $this->to = $to;
    }

    public function name(): string
    {
        return 'Бонусные баллы';
    }

    /**
     * @throws Exception
     */
    public function value(): int
    {
        return random_int($this->from, $this->to);
    }
}