<?php

namespace Rp76\LaravelPack\Pipes;

use Closure;
use Illuminate\{Database\Eloquent\Builder, Support\Facades\Auth};

class MinePipe implements PipeInterface
{
    protected bool $withOwner;

    public function __construct(bool $withOwner = false)
    {
        $this->withOwner = $withOwner;
    }

    public function handle(Builder $builder, Closure $next)
    {
        return $next($builder)->where("user_id", Auth::id())
            ->when($this->withOwner, function ($query) {
                $query->orWhere("owner_id", Auth::id());
            });
    }
}
