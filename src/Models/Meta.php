<?php

namespace Rp76\LaravelPack\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @method static where(...$arg)
 * @property mixed $metable
 */
class Meta extends Model
{
    use HasFactory;

    const
        KEY = "key",
        VALUE = "value";

    protected $fillable = [
        self::KEY,
        self::VALUE,
    ];

    public function metable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getMorphClass(): string
    {
        return class_basename(self::class);
    }
}
