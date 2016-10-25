<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyViewEventCompaniesPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if(!Auth::user()->hasPermission('VIEW_EVENT_COMPANIES', $request->route('event')->id)) {
            return redirect('403');
        }

        return $next($request);
    }
}
