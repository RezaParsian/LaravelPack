<?php

namespace Rp76\LaravelPack\Pipes;

use Closure;
use Illuminate\{Database\Eloquent\Builder};

class SelectPipe implements PipeInterface
{
    protected array $items;

    /**
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function handle(Builder $builder, Closure $next)
    {
        return $next($builder)->select($this->items);
    }
}
