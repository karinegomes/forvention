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

        if(!Auth::user()->hasPermission('MANAGE_COMPANIES')) {
            if(in_array($request->route()->getName(),
                ['company.delete_users', 'company.add_user_view', 'company.add_user', 'companies.edit', 'companies.update'])) {

                if(!Auth::user()->hasManageCompanyInfoPermission($request->route('company')->id)) {
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
