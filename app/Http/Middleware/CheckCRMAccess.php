<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCRMAccess
{
    public function handle(Request $request, Closure $next)
    {
        $crm = $request->cookie('selected_crm');

        if (!in_array($crm, ['1', '2', '3'])) {
            return redirect()->route('home');
        }

        $prefix = $request->route()?->getPrefix();

        if ($prefix && !str_contains($prefix, "crm$crm")) {
            return redirect()->route("crm{$crm}.dashboard");
        }

        return $next($request);
    }
}
