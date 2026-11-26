<?php
// router.php - Local PHP Development Server Routing for Short URLs

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $uri;

// 1. Static file requests (css, js, images, etc.)
if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    return false;
}

// 2. Short routes with slug: /states/bihar, /state/bihar, /mla/bihar, /mp/bihar
if (preg_match('#^/states?/([a-zA-Z0-9_-]+)/?$#', $uri, $m)) {
    $_GET['state'] = $m[1];
    require __DIR__ . '/states.php';
    exit;
}

if (preg_match('#^/mla/([a-zA-Z0-9_-]+)/?$#', $uri, $m)) {
    $_GET['state'] = $m[1];
    require __DIR__ . '/mla.php';
    exit;
}

if (preg_match('#^/mp/([a-zA-Z0-9_-]+)/?$#', $uri, $m)) {
    $_GET['state'] = $m[1];
    require __DIR__ . '/mp.php';
    exit;
}

// 3. Short extensionless routes: /states -> states.php, /mla -> mla.php
$trimmed_uri = trim($uri, '/');
if ($trimmed_uri !== '') {
    $php_file = __DIR__ . '/' . $trimmed_uri . '.php';
    if (file_exists($php_file)) {
        require $php_file;
        exit;
    }
}

// 4. Default homepage
require __DIR__ . '/index.php';
