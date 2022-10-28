<?php

namespace Slotegrator\Core\Entities\Gifts;

interface Gift
{
    public function name():string;
    public function value():string;
}