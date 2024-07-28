<?php

namespace App\Services;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

use App\Rules\OrderNameRule;

class OrderService
{
    CONST CODE_INVALID_PARAM = 400;

    function __construct() {}

    public function checkFormat($order = []) {
        $validator = Validator::make($order, [
            'name'    => ['regex:/^[a-zA-Z\s]+$/u',new OrderNameRule],
            'price'   => ['regex:/^\d+(\.\d{1,2})?$/','max:2000'],
            'currency'=> [Rule::in(['TWD','USD'])],
        ],[
            'name.regex' => 'Name contains non-English characters',
            'price.max'  => 'Price is over 2000',
            'price.regex'=> 'Price format is wrong',
            'currency.in'=> 'Currency format is wrong',
        ]);

        if ($validator->fails()) {
            $response = new Response(['error' => $validator->errors()->first()], self::CODE_INVALID_PARAM);

            throw new ValidationException($validator, $response);
        }
    }


    public function transFormat($order = [])
    {
        if ($order['currency'] == 'USD') {
            $order['currency'] = 'TWD';

            $twdPrice = bcmul($order['price'], 31,2);
            $intTwdPrice = (int)$twdPrice;
            $order['price'] = $intTwdPrice == $twdPrice? $intTwdPrice."": $twdPrice;
        }

        return $order;
    }
}
