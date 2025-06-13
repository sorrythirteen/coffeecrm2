<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSelectedCRM
{
    public function handle(Request $request, Closure $next)
    {
        $crm = $request->cookie('selected_crm');
        if (!in_array($crm, ['1', '2', '3'])) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
