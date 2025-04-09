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
        $data = array_map(fn($item) => $this->convertPersianNumberToEnglish->handle($item), $request->all());

        $request->merge($data);

        return $next($request);
    }
}
