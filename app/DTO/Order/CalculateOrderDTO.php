<?php

namespace App\DTO\Order;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class CalculateOrderDTO extends DataTransferObject
{
    public int $volume;

    public int $temperature;

    public Carbon $start_shelf_life;

    public Carbon $end_shelf_life;
}
