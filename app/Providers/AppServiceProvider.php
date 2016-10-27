<?php

namespace App\Providers;

use App\Company;
use App\CompanyMedia;
use App\Event;
use App\Product;
use App\Tag;
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

        Event::deleting(function(Event $event) {
            $event->companyEventDelete();
            $event->eventUserDelete();
        });

        User::deleting(function(User $user) {
            $user->companyUserDelete();
            $user->eventUserDelete();
            $user->favoriteCompaniesDelete();
            $user->favoriteFilesDelete();
            $user->favoriteProductsDelete();
        });

        Tag::deleting(function(Tag $tag) {
            $tag->productTagDelete();
        });

        Product::deleting(function(Product $product) {
            $product->tagsDelete();
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
