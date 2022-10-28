<?php

namespace Slotegrator\Core\Entities\Money;


use Exception;
use RuntimeException;

/**
 * class Money
 */
abstract class Money
{
    /**
     * @return float Amount in minor units.
     */
    abstract public function amount():float;

    /**
     * @return Currency
     */
    abstract public function currency(): Currency;

    /**
     * @param Money $money
     * @return bool
     * @throws Exception
     */
    public function isLess(Money $money):bool
    {
        if ($this->currency() !== $money->currency()) {
            throw new RuntimeException('Currencies must be the same.');
        }

        return $this->amount() < $money->amount();
    }
}