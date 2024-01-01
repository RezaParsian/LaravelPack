<?php

namespace Rp76\LaravelPack\Pipes;

use Closure;
use Illuminate\{Database\Eloquent\Builder};

class SortPipe implements PipeInterface
{
    public function handle(Builder $builder, Closure $next)
    {
        return $next($builder)->orderBy(Request()->input("column", "id"), Request()->input("dir", "desc"));
    }
}
