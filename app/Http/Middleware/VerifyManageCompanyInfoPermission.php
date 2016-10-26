<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyManageCompanyInfoPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if(!Auth::user()->hasPermission('MANAGE_COMPANY_INFO', null, $request->route('company')->id)) {
            return redirect('403');
        }

        return $next($request);
    }
}
