<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        Route::get('/',                                                fn ()      => view('front.home'))    ->name('front.home');
        Route::get(LaravelLocalization::transRoute('routes.about'),    fn ()      => view('front.about'))   ->name('front.about');
        Route::get(LaravelLocalization::transRoute('routes.services'), fn ()      => view('front.services'))->name('front.services');
        Route::get(LaravelLocalization::transRoute('routes.partners'), fn ()      => view('front.partners'))->name('front.partners');
        Route::get(LaravelLocalization::transRoute('routes.gallery'),  fn ()      => view('front.gallery')) ->name('front.gallery');
        Route::get(LaravelLocalization::transRoute('routes.faqs'),     fn ()      => view('front.faqs'))    ->name('front.faqs');
        Route::get(LaravelLocalization::transRoute('routes.blog'),     fn ()      => view('front.blog'))    ->name('front.blog');
        Route::get(LaravelLocalization::transRoute('routes.article'),  fn ($slug) => view('front.article', ['slug' => $slug]))->name('front.article');
        Route::get(LaravelLocalization::transRoute('routes.contact'),  fn ()      => view('front.contact')) ->name('front.contact');
    }
);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
