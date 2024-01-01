<?php

namespace Rp76\LaravelPack\Pipes;

use Closure;
use Illuminate\{Database\Eloquent\Builder};

class BetweenSearchPipe implements PipeInterface
{
    protected string $filed;
    protected string $boolean;
    protected ?array $search;

    public function __construct(string $filed, string $input = null, string $boolean = "and")
    {
        $this->filed = $filed;
        $this->boolean = $boolean;
        $this->search = Request()->input($input ?? $filed);
    }

    public function handle(Builder $builder, Closure $next)
    {
        return $next($builder)->when($this->search, function ($query) {
            $query->when(count($this->search) == 2, function ($query) {
                $query->whereBetween($this->filed, $this->search, $this->boolean);
            }, function ($query) {
                $key = array_keys($this->search)[0];
                $operator = [
                    "max" => "<=",
                    "min" => ">="
                ];

                $query->where($this->filed, $operator[$key], $this->search[$key], $this->boolean);
            });
        });
    }
}
