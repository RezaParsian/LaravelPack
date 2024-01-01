<?php

namespace Rp76\LaravelPack\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pipeline\Pipeline;

trait PipeAble
{
    public static function scopePipe(Builder $builder, array $pipes)
    {
        return app(Pipeline::class)
            ->send($builder)
            ->through($pipes)
            ->thenReturn();
    }

    /**
     * @param Builder $builder
     * @return LengthAwarePaginator
     */
    public function scopePage(Builder $builder): LengthAwarePaginator
    {
        return $builder->paginate(Request()->input("length"));
    }
}
