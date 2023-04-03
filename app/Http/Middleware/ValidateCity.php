<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateCity
{
    public function handle(Request $request, Closure $next)
    {
        $city = $request->input('city');

        if (!$city) {
            return redirect()->back()->with('error', 'Please enter a valid city name.');
        }

        return $next($request);
    }
}
