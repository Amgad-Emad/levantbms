<?php

use App\Http\Controllers\Dashboard\AnalyticsController;
use App\Http\Controllers\Dashboard\ContentController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\FaqController;
use App\Http\Controllers\Dashboard\LeadController;
use App\Http\Controllers\Dashboard\GalleryItemController;
use App\Http\Controllers\Dashboard\MediaController;
use App\Http\Controllers\Dashboard\PartnerController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\SeoController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', \App\Http\Middleware\TrackPageView::class],
    ],
    function () {
        Route::get('/',                                                fn ()      => view('front.home'))    ->name('front.home');
        Route::get(LaravelLocalization::transRoute('routes.about'),    fn ()      => view('front.about'))   ->name('front.about');
        Route::get(LaravelLocalization::transRoute('routes.services'), [\App\Http\Controllers\Front\ServiceController::class, 'index'])->name('front.services');
        Route::get(LaravelLocalization::transRoute('routes.partners'), [\App\Http\Controllers\Front\PartnerController::class, 'index'])->name('front.partners');
        Route::get(LaravelLocalization::transRoute('routes.gallery'),  [\App\Http\Controllers\Front\GalleryController::class, 'index'])->name('front.gallery');
        Route::get(LaravelLocalization::transRoute('routes.faqs'),     [\App\Http\Controllers\Front\FaqController::class, 'index'])->name('front.faqs');
        Route::get(LaravelLocalization::transRoute('routes.blog'),     [\App\Http\Controllers\Front\BlogController::class, 'index'])->name('front.blog');
        Route::get(LaravelLocalization::transRoute('routes.article'),  [\App\Http\Controllers\Front\BlogController::class, 'show'])->name('front.article');
        Route::get(LaravelLocalization::transRoute('routes.contact'),  fn ()      => view('front.contact')) ->name('front.contact');
        Route::post(LaravelLocalization::transRoute('routes.contact'), [\App\Http\Controllers\Front\ContactController::class, 'store'])->middleware('throttle:6,1')->name('front.contact.store');
    }
);

/*
|--------------------------------------------------------------------------
| Dashboard (admin CMS) — single-locale UI, bilingual content via forms.
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'can:access-dashboard'])->group(function () {
    // Canonical entry point — kept as `dashboard` so Breeze redirects resolve.
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Module routes live under the `dashboard.` name prefix (added per phase).
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        // Pages / editable text content
        Route::get('content', [ContentController::class, 'index'])->name('content.index');
        Route::get('content/{page}', [ContentController::class, 'edit'])->name('content.edit');
        Route::put('content/{page}', [ContentController::class, 'update'])->name('content.update');

        // Blog
        Route::resource('posts', PostController::class)->except('show');

        // Services
        Route::resource('services', ServiceController::class)->except('show');

        // SEO (per-page metadata)
        Route::get('seo', [SeoController::class, 'index'])->name('seo.index');
        Route::get('seo/{page}', [SeoController::class, 'edit'])->name('seo.edit');
        Route::put('seo/{page}', [SeoController::class, 'update'])->name('seo.update');

        // Gallery & Partners
        Route::resource('gallery', GalleryItemController::class)->except('show');
        Route::resource('partners', PartnerController::class)->except('show');
        Route::resource('faqs', FaqController::class)->except('show');

        // Media library
        Route::get('media', [MediaController::class, 'index'])->name('media.index');
        Route::post('media', [MediaController::class, 'store'])->name('media.store');
        Route::delete('media/{medium}', [MediaController::class, 'destroy'])->name('media.destroy');

        // Leads inbox
        Route::get('leads', [LeadController::class, 'index'])->name('leads.index');
        Route::get('leads/{lead}', [LeadController::class, 'show'])->name('leads.show');
        Route::put('leads/{lead}', [LeadController::class, 'update'])->name('leads.update');
        Route::delete('leads/{lead}', [LeadController::class, 'destroy'])->name('leads.destroy');

        // Analytics
        Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics');

        // Settings
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

        // Users (admins only)
        Route::resource('users', UserController::class)->except('show')->middleware('can:manage-users');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
