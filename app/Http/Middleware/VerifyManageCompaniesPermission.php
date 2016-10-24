<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyManageCompaniesPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if(!Auth::user()->mainRole || !Auth::user()->mainRole->hasPermission('MANAGE_COMPANIES')) {
            if(in_array($request->route()->getName(), ['companies.show', 'companies.users'])) {
                if((Auth::user()->isVisitor() && !Auth::user()->hasEventPermission('VIEW_COMPANY', null, $request->route('company')->id)) ||
                    Auth::user()->isPresentor() && !Auth::user()->hasCompanyPermission('VIEW_COMPANY', $request->route('company')->id)) {

                    return redirect('403');
                }
            }
            else if($request->route()->getName() == 'companies.index') {
                if(Auth::user()->isPresentor() && !Auth::user()->hasCompanyPermission('VIEW_COMPANIES')) {
                    return redirect('403');
                }
            }
            else {
                return redirect('403');
            }
        }

        return $next($request);
    }
}
