<?php
// Installation Validator
header('Content-Type: application/json');

$results = [
    'php_version' => [
        'required' => '7.4.0',
        'current' => PHP_VERSION,
        'status' => version_compare(PHP_VERSION, '7.4.0', '>='),
        'message' => version_compare(PHP_VERSION, '7.4.0', '>=') ? 'PHP version is compatible' : 'PHP version is too old'
    ],
    'extensions' => [
        'pdo' => extension_loaded('pdo'),
        'pdo_mysql' => extension_loaded('pdo_mysql'),
        'openssl' => extension_loaded('openssl'),
        'mbstring' => extension_loaded('mbstring'),
        'json' => extension_loaded('json')
    ],
    'file_permissions' => [
        'root_writable' => is_writable('../'),
        'env_writable' => is_writable('../.env') || !file_exists('../.env'),
        'uploads_writable' => is_writable('uploads/') || !file_exists('uploads/')
    ],
    'env_file' => file_exists('../.env'),
    'install_sql' => file_exists('../install.sql'),
    'database_connection' => false,
    'database_tables' => false
];

// Test database connection if .env exists
if (file_exists('../.env')) {
    $env_lines = file('../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $env_vars = [];
    foreach ($env_lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $env_vars[trim($key)] = trim($value);
        }
    }

    if (isset($env_vars['DB_HOST'], $env_vars['DB_NAME'], $env_vars['DB_USER'])) {
        try {
            $dsn = "mysql:host={$env_vars['DB_HOST']};dbname={$env_vars['DB_NAME']}";
            $pdo = new PDO($dsn, $env_vars['DB_USER'], $env_vars['DB_PASS'] ?? '');
            $results['database_connection'] = true;

            // Check if tables exist
            $stmt = $pdo->query("SHOW TABLES");
            $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
            $required_tables = ['admins', 'categories', 'channels', 'movies', 'anime', 'episodes', 'ad_settings', 'app_settings'];
            $results['database_tables'] = count(array_intersect($required_tables, $tables)) === count($required_tables);

        } catch (PDOException $e) {
            $results['database_connection'] = false;
            $results['database_error'] = $e->getMessage();
        }
    }
}

echo json_encode($results, JSON_PRETTY_PRINT);
?>