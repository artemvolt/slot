<?php

namespace Slotegrator\Core\Entities\User;

use RuntimeException;
use Slotegrator\Core\Entities\Gifts\Gift;
use Slotegrator\Core\Entities\User as IUser;

/**
 * class NoneExisting
 */
class NoneExisting implements IUser
{
    public function isExisting(): bool
    {
        return false;
    }

    public function isEqualPass(Password $pass):bool
    {
        throw new RuntimeException("Wrong scenario");
    }

    public function winGift(Gift $gift): void
    {
        throw new RuntimeException("Wrong scenario");
    }
}