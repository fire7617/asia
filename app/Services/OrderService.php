<?php

namespace App\Services;

use App\Services\MotelOrder;


class OrderService
{
    CONST CODE_INVALID_PARAM = 400;

    private $orderStrategy;

    public function __construct(string $type) {
        $this->orderStrategy = match($type) {
            'motel' => new MotelOrder(),
            default => new MotelOrder(),
        };
    }

    public function checkFormat($order = []) {
        $this->orderStrategy->checkFormat($order);
    }


    public function transFormat($order = [])
    {
        return $this->orderStrategy->transFormat($order);
    }
}
