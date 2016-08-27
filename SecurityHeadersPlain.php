<?php
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

$keyPins = [
    'pin-sha256="";',
    'pin-sha256="";',
    'pin-sha256="";'
];

$headers = [
    'X-Frame-Options'           => 'DENY',
    'X-Content-Type-Options'    => 'nosniff',
    'X-XSS-Protection'          => '1;mode=block',
    'Content-Security-Policy'   => join(' ', $csp),
    'Public-Key-Pins'           => join(' ', $keyPins) . ' includeSubdomains; max-age=31536000',
    'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains; preload',
    'X-Powered-By'              => 'my pretty hands',
];

foreach ($headers as $header => $value) {
    header($header . ': ' . $value);
}