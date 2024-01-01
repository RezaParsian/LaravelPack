<?php

namespace Rp76\LaravelPack\Pipes;

use Closure;
use Illuminate\{Database\Eloquent\Builder};

class SearchPipe implements PipeInterface
{
    protected string $filed;
    protected string $boolean;
    protected ?string $input;
    protected ?string $search;
    protected string $operator;

    public function __construct(string $filed, string $boolean = "and", string $input = null, bool $fullSearch = false)
    {
        $this->filed = $filed;
        $this->boolean = $boolean;
        $this->input = $input;

        if ($fullSearch) {
            $this->operator = "=";
            $this->search = Request()->input($this->input ?? "search");
        } else {
            $this->operator = "like";
            $this->search = "%" . Request()->input($this->input ?? "search") . "%";
        }
    }

    public function handle(Builder $builder, Closure $next)
    {
        return $next($builder)->when($this->search and $this->search != "%%", function ($query) {
            $query->where($this->filed, $this->operator, $this->search, $this->boolean);
        });
    }
}
