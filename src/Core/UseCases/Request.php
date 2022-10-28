<?php

namespace Slotegrator\Core\UseCases;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class Request
{
    protected ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)  {
        $this->validator = $validator;
    }

    abstract public function validate():ConstraintViolationListInterface;
}