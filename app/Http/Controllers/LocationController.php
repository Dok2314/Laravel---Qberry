<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Location;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function orders()
    {
        $orders = Order::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders', compact('orders'));
    }

    public function calculateView(Location $location)
    {
        return view('calculator', compact('location'));
    }

    public function calculatePreview(Location $location, OrderRequest $request)
    {
        $calculation = $this->orderService->calculateOrder($location, $request->getCalculationDTO());

        return view('calculate-preview', compact('location','calculation'));
    }

    public function calculatePreviewAction(OrderRequest $request)
    {
        if ($request->input('action') === 'back') {
            session()->flashInput($request->validated());

            return redirect()
                ->route('calculate.view', $request->route('location'));
        }

        return back();
    }

    public function orderCreate(Location $location, OrderRequest $request)
    {
        $calculation = $this->orderService->calculateOrder($location, $request->getCalculationDTO());

        $this->orderService->create($request->user(), $location, $calculation);

        return redirect()->route('calculate.orders')->with('success', sprintf('Ваш заказ успешно забронирован!'));
    }
}
