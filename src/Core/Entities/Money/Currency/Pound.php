<?php

namespace Slotegrator\Core\Entities\Money\Currency;

use Slotegrator\Core\Entities\Money\Currency;

class Pound implements Currency
{
    public function isoCode():string
    {
        return 'GBP';
    }
}
