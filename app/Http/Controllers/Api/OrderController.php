<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
use App\Models\User;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function orderCreate(OrderRequest $request)
    {
        $location = $request->getLocation();

        $calculation = $this->orderService->calculateOrder($location, $request->getCalculationDTO());

        $this->orderService->create(User::find(1), $location, $calculation);

        return [
            'result' => 'Ваш заказ успешно забронирован!'
        ];
    }
}
