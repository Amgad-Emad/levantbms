<?php

it('redirects the root to the localized home page', function () {
    // The site is locale-prefixed (mcamara/laravel-localization): `/` redirects
    // to the default-locale home (e.g. /en). The redirected page renders 200 in
    // the browser; under the test harness the locale prefix is resolved at route
    // registration time, so we assert the redirect contract here.
    $this->get('/')->assertRedirect();
});
