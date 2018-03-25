<?php

namespace App\Http\Middleware;

use Closure;
Use Cookie;
Use Config;
USE App;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $raw_locale = Cookie::get('locale');
        if (in_array($raw_locale, Config::get('app.locales'))) {
            $locale = $raw_locale;
        } else $locale = Config::get('app.locale');
        
        App::setLocale($locale);
        
        return $next($request);
    }
}
