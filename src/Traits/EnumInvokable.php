<?php

namespace Rp76\LaravelPack\Traits;

use Arr;
use Throwable;

trait EnumInvokable
{
    /**
     * @throws Throwable
     */
    public static function __callStatic(string $name, array $arguments)
    {
        $case = Arr::first(self::cases(), fn($case) => $case->name == $name);

        if (!$case) {
            throw new \Exception(sprintf('Undefined Enum Case %s::%s', static::class, $name));
        }

        return $case->value ?? $case->name;
    }
}
