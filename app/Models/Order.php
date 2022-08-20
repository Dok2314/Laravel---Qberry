<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_ACTIVE = 1;

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

    protected $casts = [
        'start_shelf_life' => 'date',
        'end_shelf_life'   => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function getShelfLifeDaysAttribute()
    {
        return $this->start_shelf_life->diffInDays($this->end_shelf_life);
    }
}
