<?php

namespace Rp76\LaravelPack\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConvertFaNumberToEnMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $data = array_map(fn($item) => faToEn($item), $request->all());

        $request->merge($data);

        return $next($request);
    }
}
