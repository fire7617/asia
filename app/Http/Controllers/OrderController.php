<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Http\Requests\OrderPostRequest;

use App\Services\OrderService;

class OrderController extends Controller
{
    private $service = null;


    public function __construct() {
    }

    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function order(OrderPostRequest $request)
    {
        $this->service = new OrderService('motel');
        $this->service->checkFormat($request->all());
        $order = $this->service->transFormat($request->all());

        return response()->json($order);
    }
}
