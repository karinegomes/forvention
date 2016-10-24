<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyManageEventsPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        // Check if the user doesn't have permission to manage evemts
        if(!Auth::user()->mainRole || !Auth::user()->mainRole->hasPermission('MANAGE_EVENTS')) {
            // Check if it's index/show route
            if(in_array($request->route()->getName(), ['events.index', 'events.show', 'events.companies'])) {
                // Check if the user is not a visitor
                if(!Auth::user()->isVisitor()) {
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
