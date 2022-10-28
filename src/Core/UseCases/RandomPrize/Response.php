<?php

namespace Slotegrator\Core\UseCases\RandomPrize;

use Slotegrator\Core\Entities\Gifts\Gift;
use Slotegrator\Core\UseCases\Response as BaseResponse;

/**
 * class Response
 */
class Response extends BaseResponse
{
    public Gift $gift;
}