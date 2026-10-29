<?php
declare(strict_types=1);

/**
 * Week 7: Implementasi Arsitektur MVC (Model - View - Controller)
 * Project: PJ Laundry
 *
 * Front Controller & Single Entry Point
 */

// Register Class Autoloader
spl_autoload_register(static function (string $className): void {
    $directories = [
        __DIR__ . '/controllers/',
        __DIR__ . '/models/',
        __DIR__ . '/helpers/',
    ];

    foreach ($directories as $directory) {
        $file = $directory . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Front Controller Dispatching
$controller = new LaundryController();
$action = isset($_GET['action']) && is_string($_GET['action']) ? trim($_GET['action']) : 'index';

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    http_response_code(404);
    echo '<!doctype html><html><body style="font-family:sans-serif;text-align:center;padding:50px;">';
    echo '<h1>404 - Halaman / Aksi Tidak Ditemukan</h1>';
    echo '<p><a href="/week-7/">Kembali ke Beranda PJ Laundry</a></p>';
    echo '</body></html>';
}
