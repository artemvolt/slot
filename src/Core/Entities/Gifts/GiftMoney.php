<?php

namespace Slotegrator\Core\Entities\Gifts;

use Slotegrator\Core\Entities\Money\Money;

/**
 * class GiftMoney
 */
class GiftMoney implements Gift
{
    private Money $money;

    public function __construct(Money $money) {
        $this->money = $money;
    }

    public function name(): string
    {
        return 'Денежная сумма';
    }

    public function value(): string
    {
        return "{$this->money->amount()} {$this->money->currency()->isoCode()}";
    }
}