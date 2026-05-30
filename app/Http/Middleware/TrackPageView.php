<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageView
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $this->record($request, $response);

        return $response;
    }

    protected function record(Request $request, Response $response): void
    {
        if (! $request->isMethod('get') || $request->ajax() || $request->is('dashboard*')) {
            return;
        }

        if ($response->getStatusCode() !== 200) {
            return;
        }

        $contentType = (string) $response->headers->get('Content-Type');
        if ($contentType !== '' && ! str_contains($contentType, 'text/html')) {
            return;
        }

        $agent = (string) $request->userAgent();
        if ($this->isBot($agent)) {
            return;
        }

        try {
            PageView::create([
                // Store the human-readable path (decode %xx so Arabic URLs are legible).
                'path' => rawurldecode('/'.ltrim($request->path(), '/')),
                'route_name' => optional($request->route())->getName(),
                'locale' => app()->getLocale(),
                'referrer' => $request->headers->get('referer'),
                'session_id' => $request->hasSession() ? $request->session()->getId() : null,
                'ip_hash' => $request->ip() ? hash('sha256', $request->ip()) : null,
                'device' => $this->device($agent),
                'user_agent' => mb_substr($agent, 0, 500),
                'created_at' => now(),
            ]);
        } catch (\Throwable) {
            // Never let analytics logging break a page render.
        }
    }

    protected function isBot(string $agent): bool
    {
        return $agent === '' || (bool) preg_match('/bot|crawl|spider|slurp|bing|google|facebookexternalhit|monitor|curl|wget|headless/i', $agent);
    }

    protected function device(string $agent): string
    {
        if (preg_match('/mobile|iphone|android.*mobile/i', $agent)) {
            return 'mobile';
        }
        if (preg_match('/ipad|tablet|android/i', $agent)) {
            return 'tablet';
        }

        return 'desktop';
    }
}
