<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Block;
use App\Models\Location;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class LocationController extends Controller
{
    public function calculateView(Location $location)
    {
        $location = Location::where('id', $location->id)->first();

        return view('calculator',compact('location'));
    }

    public function calculateOrder(Location $location, OrderRequest $request)
    {
        $volume               = $request->volume;
        $storageCostPerBlock  = 15;
        $notEnoughBlock       = false;

        $neededTemperature    = $request->temperature;
        $startShelfLife       = $request->start_shelf_life;
        $endShelfLife         = $request->end_shelf_life;

        $blockVolume          = Block::WIDTH * Block::LENGTH * Block::HIGH;
        $blocksNeed           = ceil($volume / $blockVolume);
        $availableBlockCount  = $location->availableBlocksCountByLocationId($location->id);
        $price                = $storageCostPerBlock * $blocksNeed;

        $notEnoughBlock       = $availableBlockCount >= $blocksNeed;

        return view('order', compact('location','blocksNeed','availableBlockCount', 'price', 'neededTemperature','startShelfLife','endShelfLife', 'notEnoughBlock','volume'));
    }

    public function orderCreate(Request $request)
    {
        //default V block (m/3)
        $blockVolume         = Block::WIDTH * Block::LENGTH * Block::HIGH;
        $volume              = $request->volume;
        $blocksNeed          = ceil($volume / $blockVolume);
        $availableBlockCount = $request->available_blocks;

        if($availableBlockCount >= $blocksNeed) {
            $token = Str::random(12);

            $order = new Order([
                'user_id'               => Auth::user()->id,
                'location_id'           => $request->location_id,
                'volume'                => $request->volume,
                'needed_temperature'    => $request->temperature,
                'start_shelf_life'      => $request->start_shelf_life,
                'end_shelf_life'        => $request->end_shelf_life,
                'blocks_count'          => $blocksNeed,
                'token'                 => $token,
                'status'                => 1,
                'price'                 => $request->price
            ]);

            $order->save();
        }else{
            //TODO: make normal exception alert
            throw ValidationException::withMessages(['Недостаточно морозильных камер!']);
        }

        return redirect()->route('calculate.orders')->with('success', sprintf('Ваш заказ успешно забронирован!'));
    }

    public function orders()
    {
        $orders = Order::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders', compact('orders'));
    }
}
