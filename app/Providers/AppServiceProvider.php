<?php

namespace App\Providers;

use App\Models\User;
use App\Translation\DatabaseTranslationLoader;
use App\View\Composers\SeoComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Override the translation loader so editable `front` content is read
        // from the database (with the lang files as a fallback).
        //
        // We use extend() rather than re-binding the singleton because the
        // framework's TranslationServiceProvider is *deferred* and rebinds
        // `translation.loader` to a FileLoader when the translator is first
        // resolved. An extender is applied whenever the abstract is resolved
        // (including via that deferred provider), so our loader always wins.
        $this->app->extend('translation.loader', function ($loader, $app) {
            return new DatabaseTranslationLoader($app['files'], $app->langPath());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('access-dashboard', fn (User $user) => $user->canAccessDashboard());
        Gate::define('manage-users', fn (User $user) => $user->isAdmin());

        // Dashboard tables use Bootstrap 5 markup.
        Paginator::useBootstrapFive();

        // Resolve per-page SEO metadata + JSON-LD for the public site.
        View::composer('front.layout', SeoComposer::class);
    }
}
