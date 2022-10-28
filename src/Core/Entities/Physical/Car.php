<?php

namespace Slotegrator\Core\Entities\Physical;

/**
 * class Car
 */
class Car implements Physical
{
    public function name(): string
    {
        return 'Автомобиль';
    }
}