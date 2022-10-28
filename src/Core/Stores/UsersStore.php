<?php

namespace Slotegrator\Core\Stores;

use Slotegrator\Core\Entities\User;

interface UsersStore
{
    public function findByLoginWithPass(string $login):User;
}