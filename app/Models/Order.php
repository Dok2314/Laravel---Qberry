<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'id',
        'user_id',
        'location_id',
        'volume',
        'needed_temperature',
        'start_shelf_life',
        'end_shelf_life',
        'blocks_count',
        'token',
        'status',
        'price'
    ];

    public function findLocationById($location_id)
    {
        $location = Location::find($location_id);

        return $location;
    }
}
