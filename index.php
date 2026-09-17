<?php
/**
 * Fail-safe front controller for Hostinger.
 * Always serves the static homepage so a broken PHP app cannot take the site offline.
 */
declare(strict_types=1);

$htmlFile = __DIR__ . DIRECTORY_SEPARATOR . 'index.html';

if (is_readable($htmlFile)) {
    header('Content-Type: text/html; charset=UTF-8');
    header('X-Content-Type-Options: nosniff');
    header('Cache-Control: public, max-age=300');
    readfile($htmlFile);
    exit;
}

// Absolute last resort if index.html is missing
http_response_code(503);
header('Content-Type: text/html; charset=UTF-8');
echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Walo Enterprises</title></head>';
echo '<body style="font-family:sans-serif;background:#0a0a0a;color:#fff;padding:2rem;">';
echo '<h1>Walo Enterprises</h1><p>The site is temporarily unavailable. Please try again shortly.</p>';
echo '<p><a href="mailto:info@waloenterprises.com.au" style="color:#e53935;">info@waloenterprises.com.au</a></p>';
echo '</body></html>';
exit;
