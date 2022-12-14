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

    public static function availableBlocksCountByLocationId($location_id)
    {
        $blocks = Block::query()
            ->where('location_id', $location_id)
            ->whereAvailable(1)
            ->count();

        $blocks -= Order::query()
            ->where('location_id', $location_id)
            ->sum('blocks_count');

        return $blocks;
    }
}
