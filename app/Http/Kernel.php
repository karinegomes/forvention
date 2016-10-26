<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'manage_users' => \App\Http\Middleware\VerifyManageUsersPermission::class,
        'manage_events' => \App\Http\Middleware\VerifyManageEventsPermission::class,
        'manage_events.companies' => \App\Http\Middleware\VerifyManageCompaniesEventPermission::class,
        'manage_events.users' => \App\Http\Middleware\VerifyManageUsersEventPermission::class,
        'manage_events.edit' => \App\Http\Middleware\VerifyManageEventInfoPermission::class,
        'manage_events.view_companies' => \App\Http\Middleware\VerifyViewEventCompaniesPermission::class,
        'manage_events.view' => \App\Http\Middleware\VerifyViewEventsPermission::class,
        'manage_companies' => \App\Http\Middleware\VerifyManageCompaniesPermission::class,
        'manage_companies.view_events' => \App\Http\Middleware\VerifyViewCompanyEventsPermission::class,
        'manage_companies.view' => \App\Http\Middleware\VerifyViewCompaniesPermission::class,
        'manage_companies.show' => \App\Http\Middleware\VerifyViewCompanyPermission::class,
        'manage_companies.edit' => \App\Http\Middleware\VerifyManageCompanyInfoPermission::class,
    ];
}
