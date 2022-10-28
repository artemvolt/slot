<?php

namespace Slotegrator\Core\Entities\Gifts;

use Slotegrator\Core\Components\Collection;
use Webmozart\Assert\Assert;

/**
 * class GifsCollection
 *
 * @property Gift[] $items
 */
class GifsCollection extends Collection
{
    public function __construct(array $items = [])
    {
        Assert::allIsInstanceOf($items, Gift::class);
        parent::__construct($items);
    }
}