<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class lang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$lang): Response
    {

        $available_langs = ['ar', 'en'];

        // Get the language from the request and set default if not valid
        $lang = $request->route('lang', 'ar'); // Get lang from route parameter
        if (!in_array($lang, $available_langs)) {
            $lang = 'ar'; // Default to Arabic if invalid
        }

        // Set the application locale
        App::setLocale($lang);

        return $next($request);

    }
}
