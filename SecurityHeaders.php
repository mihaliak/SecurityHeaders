<?php
namespace App\Http\Middleware;

use Closure;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $response = $next($request);

        $response->withHeaders(
            $this->getHeaders()
        );

        return $response;
    }

    /**
     * Security headers
     *
     * @return array
     */
    private function getHeaders()
    {
        $csp = [
            "default-src 'none';",
            "img-src 'self' https://www.google-analytics.com;",
            "script-src 'self' https://www.google-analytics.com;",
            "style-src 'self' https://fonts.googleapis.com;",
            "font-src 'self' https://fonts.gstatic.com;",
            "frame-ancestors 'none';",
            "form-action 'self';",
            "upgrade-insecure-requests;",
            "block-all-mixed-content;"
        ];

        return [
            'X-Frame-Options'           => 'SAMEORIGIN',
            'X-Content-Type-Options'    => 'nosniff',
            'X-XSS-Protection'          => '1;mode=block',
            'Content-Security-Policy'   => join(' ', $csp),
            'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains; preload',
            'X-Powered-By'              => 'my pretty hands',
        ];
    }
}
