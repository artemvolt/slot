<?php

namespace Slotegrator\Core\Entities\User;

use Slotegrator\Core\Components\Collection;
use Slotegrator\Core\Entities\User;
use Webmozart\Assert\Assert;

/**
 * class UsersCollection
 */
class UsersCollection extends Collection
{
    public function __construct(array $items = [])
    {
        Assert::allIsInstanceOf($items, User::class);
        parent::__construct($items);
    }
}