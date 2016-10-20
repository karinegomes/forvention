<?php

namespace App\Providers;

use App\Company;
use App\CompanyMedia;
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
