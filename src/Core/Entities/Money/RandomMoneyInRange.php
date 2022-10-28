<?php

namespace Slotegrator\Core\Entities\Money;

use DomainException;
use Exception;

/**
 * class RandomInRangeMoney
 */
class RandomMoneyInRange extends Money
{
    protected Money $from;
    protected Money $to;

    /**
     * @throws Exception
     */
    public function __construct(Money $from, Money $to) {
        $this->from = $from;
        $this->to = $to;

        if ($from->isLess($to)) {
            throw new DomainException("From money must be less than to");
        }
    }

    /**
     * @throws Exception
     */
    public function amount(): float
    {
        return random_int($this->from->amount(), $this->from->amount());
    }

    public function currency(): Currency
    {
        return $this->from->currency();
    }
}