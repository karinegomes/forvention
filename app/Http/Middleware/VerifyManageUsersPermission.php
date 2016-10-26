<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyManageUsersPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        // Check if the user doesn't have permission to manage users
        if(!Auth::user()->mainRole || !Auth::user()->mainRole->hasPermission('MANAGE_USERS')) {
            // Check if it's edit/update rote
            if(in_array($request->route()->getName(), ['users.edit', 'users.update'])) {
                // Check if the user is not himself
                if($request->route('user')->id != Auth::user()->id && !Auth::user()->hasEditUserPermission($request->route('user'))) {
                    return redirect('403');
                }
            }
            else if($request->route()->getName() == 'users.index') {
                return redirect('/');
            }
            else {
                return redirect('403');
            }
        }

        return $next($request);
    }
}
