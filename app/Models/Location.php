<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'locations';

    protected $fillable = [
        'id',
        'name',
        'slug',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function locations()
    {
        return self::all();
    }

    public function blocks()
    {
        return $this->hasMany(Block::class, 'location_id','id');
    }

    public function availableBlocksCountByLocationId($location_id)
    {
        $order = Order::where('location_id', $location_id)->get();

        if($order->count() > 0) {
            $blocks_count = 0;

            foreach ($order as $item) {
                $blocks_count += $item->blocks_count;
            }
        }

        $blocks = $this->blocks()
            ->where('location_id', $location_id)
            ->whereAvailable(1)
            ->count();

        if(isset($blocks_count)) {
            return $blocks - $blocks_count;
        }

        return $blocks;
    }
}
