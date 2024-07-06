<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationMiddleware
{
    private const string DEFAULT_LANGUAGE = 'ru';

    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('Accept-Language')) {
            App::setLocale(
                $request->header(
                    key: "Accept-Language",
                    default: self::DEFAULT_LANGUAGE
                )
            );
        }

        return $next($request);
    }
}
