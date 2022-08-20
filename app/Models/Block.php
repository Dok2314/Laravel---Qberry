<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Block extends Model
{
    use HasFactory, SoftDeletes;

    const LENGTH = 2;
    const HIGH   = 1;
    const WIDTH  = 1;

    const VOLUME = self::WIDTH * self::LENGTH * self::HIGH;

    protected $table = 'blocks';

    protected $fillable = [
        'id',
        'name',
        'slug',
        'location_id',
        'available',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
}
