<?php

namespace Rp76\LaravelPack\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Rp76\LaravelPack\Actions\ConvertPersianNumberToEnglish;
use Symfony\Component\HttpFoundation\Response;

class ConvertFaNumberToEnMiddleware
{
    private ConvertPersianNumberToEnglish $convertPersianNumberToEnglish;

    public function __construct(ConvertPersianNumberToEnglish $convertPersianNumberToEnglish)
    {
        $this->convertPersianNumberToEnglish = $convertPersianNumberToEnglish;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $data = $this->recursivelyConvertNumbers($request->all());
        $request->merge($data);

        return $next($request);
    }

    protected function recursivelyConvertNumbers(array $items)
    {
        return array_map(function ($item) {
            if (is_array($item))
                return $this->recursivelyConvertNumbers($item);

            if (is_numeric($item) or is_bool($item))
                return $item;

            return $this->convertPersianNumberToEnglish->handle($item);
        }, $items);
    }
}
