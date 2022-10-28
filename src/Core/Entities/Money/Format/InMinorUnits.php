<?php

namespace Slotegrator\Core\Entities\Money\Format;

use InvalidArgumentException;
use Slotegrator\Core\Entities\Money\Currency;
use Slotegrator\Core\Entities\Money\Money;

class InMinorUnits extends Money
{
    /**
     * @var float
     */
    private float $amount;

    /**
     * @var Currency
     */
    private Currency $currency;

    public function __construct(float $amount, Currency $currency)
    {
        if (!ctype_digit((string) $amount) || $amount < 0) {
            throw new InvalidArgumentException('Invalid amount format.');
        }

        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function currency():Currency
    {
        return $this->currency;
    }

    public function amount(): float
    {
        return $this->amount;
    }
}