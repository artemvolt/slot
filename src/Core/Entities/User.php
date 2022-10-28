<?php

namespace Slotegrator\Core\Entities;

use Slotegrator\Core\Entities\Gifts\Gift;
use Slotegrator\Core\Entities\User\Password;

interface User
{
    public function isExisting():bool;

    public function isEqualPass(Password $pass):bool;

    public function winGift(Gift $gift):void;
}