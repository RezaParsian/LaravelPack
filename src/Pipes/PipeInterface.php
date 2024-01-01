<?php

namespace Rp76\LaravelPack\Pipes;

use Closure;
use Illuminate\Database\Eloquent\Builder;

interface PipeInterface
{
    public function handle(Builder $builder, Closure $next);
}
