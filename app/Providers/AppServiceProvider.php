<?php

namespace App\Providers;

use App\Company;
use App\CompanyMedia;
use App\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        CompanyMedia::deleting(function(CompanyMedia $media) {
            $media->favoriteFilesDelete();
        });

        Company::deleting(function(Company $company) {
            $company->companyEventDelete();
            $company->companyUserDelete();
            $company->medias()->delete();
        });

        User::deleting(function(User $user) {
            $user->companyUserDelete();
            $user->eventUserDelete();
            $user->favoriteCompaniesDelete();
            $user->favoriteFilesDelete();
            $user->favoriteProductsDelete();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
