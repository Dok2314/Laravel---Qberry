<?php

namespace App\Services;

use App\DTO\Order\CalculateOrderDTO;
use App\DTO\Order\CalculationOrderResultDTO;
use App\Models\Block;
use App\Models\Location;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function calculateOrder(Location $location, CalculateOrderDTO $dto)
    {
        $volume               = $dto->volume;
        $storageCostPerBlock  = 15;

        $blocksNeed           = (int) ceil($volume / Block::VOLUME);
        $availableBlockCount  = Location::availableBlocksCountByLocationId($location->id);

        return new CalculationOrderResultDTO([
            'recipe'                => $dto,
            'blocks_need'           => $blocksNeed,
            'available_block_count' => $availableBlockCount,
            'price'                 => $storageCostPerBlock * $blocksNeed,
        ]);
    }

    public function create(User $user, Location $location, CalculationOrderResultDTO $dto)
    {
        if ($dto->isBlockCountUnavailable()) {
            throw ValidationException::withMessages(['error' => 'Недостаточно морозильных камер!']);
        }

        $token = Str::random(12);

        $order = new Order([
            'volume'                => $dto->recipe->volume,
            'needed_temperature'    => $dto->recipe->temperature,
            'start_shelf_life'      => $dto->recipe->start_shelf_life,
            'end_shelf_life'        => $dto->recipe->end_shelf_life,
            'blocks_count'          => $dto->blocks_need,
            'token'                 => $token,
            'status'                => Order::STATUS_ACTIVE,
            'price'                 => $dto->price
        ]);

        $order->user()->associate($user);
        $order->location()->associate($location);

        $order->save();

        return $order;
    }
}
