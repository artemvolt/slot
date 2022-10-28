<?php

namespace Slotegrator\Core\Entities\Money\Currency;

use Slotegrator\Core\Entities\Money\Currency;

class USDollar implements Currency
{
    public function isoCode():string
    {
        return 'USD';
    }
}
