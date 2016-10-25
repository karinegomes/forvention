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

            if($request->route()->getName() == 'events.index') {
                if(!Auth::user()->hasEventPermission('VIEW_EVENTS') && !Auth::user()->hasCompanyPermission('VIEW_EVENTS')) {
                    return redirect('403');
                }
            }
            else if(in_array($request->route()->getName(), ['events.show', 'events.companies'])) {
                if(!Auth::user()->hasEventPermission('VIEW_EVENT', $request->route('event')->id) &&
                    !Auth::user()->hasCompanyPermission('VIEW_EVENT', null, $request->route('event')->id)) {
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
