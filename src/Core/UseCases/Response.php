<?php

namespace Slotegrator\Core\UseCases;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Throwable;

/**
 * class Response
 */
class Response
{
    private bool $isSuccess;
    private array $validateErrors;
    private ?string $domain;

    private function __construct(bool $isSuccess, ?string $domain = null, array $validateErrors = []) {
        $this->isSuccess = $isSuccess;
        $this->domain = $domain;
        $this->validateErrors = $validateErrors;
    }

    /**
     * @return static
     */
    public static function success():static {
        return new static(true, null, []);
    }

    public static function domain(Throwable $exception):static {
        return new static(false,  $exception->getMessage());
    }

    /**
     * @param ConstraintViolationListInterface $errors
     * @return static
     */
    public static function validateErrors(ConstraintViolationListInterface $errors):static {
        return new static(false,
            null,
            [$errors[0]->getMessage()]
        );
    }

    /**
     * @return string
     */
    public function getErrorText():string {
        if ( ! empty($this->validateErrors)) {
            return implode(". ", $this->validateErrors);
        }
        return $this->domain;
    }

    /**
     * @return array
     */
    public function getValidationErrors():array {
        return $this->validateErrors;
    }

    /**
     * @return bool
     */
    public function isSuccess():bool {
        return $this->isSuccess === true;
    }

    public function isValidateErrors():bool {
        return ! empty($this->validateErrors);
    }
}