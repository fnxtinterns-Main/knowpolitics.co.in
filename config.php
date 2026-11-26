<?php
// config.php - Configuration & Language Handler
if (session_status() === PHP_SESSION_NONE) {
    // Ensure session directory is writable
    $session_dir = sys_get_temp_dir();
    if (is_dir($session_dir) && is_writable($session_dir)) {
        @session_save_path($session_dir);
    }
    @session_start();
}

// Handle language selection
if (isset($_GET['lang'])) {
    $requested_lang = strtolower(trim($_GET['lang']));
    if (in_array($requested_lang, ['hi', 'en'])) {
        $_SESSION['lang'] = $requested_lang;
    }
}

// Default language: English as primary, fallback to Hindi if chosen
$current_lang = $_SESSION['lang'] ?? 'en';

// Load translation dictionaries
$lang_file = __DIR__ . "/lang/{$current_lang}.php";
$translations = file_exists($lang_file) ? require $lang_file : require __DIR__ . "/lang/en.php";

// Helper translation function
function __t($key, $default = '') {
    global $translations;
    return $translations[$key] ?? ($default ?: $key);
}

// App metadata
define('APP_NAME', 'KNOW POLITICS');
define('APP_TAGLINE_HI', 'भारतीय लोकतंत्र के प्रति जन-जागरूकता');
define('APP_TAGLINE_EN', 'Educating Everyone About Indian Democracy');
define('BASE_URL', '');
