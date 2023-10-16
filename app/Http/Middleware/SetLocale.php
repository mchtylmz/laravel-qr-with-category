<?php

namespace App\Http\Middleware;

use App\Enums\LocaleEnum;
use Closure;
use \Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{

    /**
     * @var string
     */
    public static string $langName = 'sys_lang';
    /**
     * @var int|float
     */
    public static int $langTime = 86400 * 30;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($lang = request('lang')) {
            Cookie::queue(self::$langName, request('lang'), time() + self::$langTime);
        } elseif (Cookie::has(self::$langName)) {
            $lang = Cookie::get(self::$langName);
        } elseif (config('app.locale')) {
            $lang = config('app.locale');
        }

        if (!empty($lang)) {
            app()->setLocale($lang);
        }

        return $next($request);
    }
}
