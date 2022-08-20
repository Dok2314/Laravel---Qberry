<?php

namespace App\DTO\Order;

use Spatie\DataTransferObject\DataTransferObject;

class CalculationOrderResultDTO extends DataTransferObject
{
    public CalculateOrderDTO $recipe;

    public int $block_volume;

    public int $blocks_need;

    public int $available_block_count;

    public int $price;

    public bool $not_enough_block;

    public function isBlockCountUnavailable()
    {
        return $this->available_block_count <= $this->blocks_need;
    }
}
