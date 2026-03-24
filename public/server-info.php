<?php
// Server Information and Debugging Tool
echo "<h1>AbdouTV - Server Information</h1>";
echo "<h2>PHP Version: " . PHP_VERSION . "</h2>";

// Check extensions
$extensions = ['pdo', 'pdo_mysql', 'openssl', 'mbstring', 'json'];
echo "<h3>PHP Extensions:</h3><ul>";
foreach ($extensions as $ext) {
    $status = extension_loaded($ext) ? '<span style="color:green">✓ Loaded</span>' : '<span style="color:red">✗ Not loaded</span>';
    echo "<li>{$ext}: {$status}</li>";
}
echo "</ul>";

// Check file permissions
$files_to_check = [
    '../.env' => 'Environment file',
    '../install.sql' => 'SQL schema file',
    '../app/Controllers/' => 'Controllers directory',
    '../views/' => 'Views directory',
    '../routes/' => 'Routes directory'
];

echo "<h3>File Permissions:</h3><ul>";
foreach ($files_to_check as $file => $description) {
    $exists = file_exists($file) ? '<span style="color:green">✓ Exists</span>' : '<span style="color:red">✗ Missing</span>';
    $writable = is_writable($file) ? '<span style="color:green">✓ Writable</span>' : '<span style="color:red">✗ Not writable</span>';
    echo "<li>{$description} ({$file}): {$exists} | {$writable}</li>";
}
echo "</ul>";

// Check .env content
echo "<h3>Environment File Content:</h3>";
if (file_exists('../.env')) {
    $env_content = file_get_contents('../.env');
    echo "<pre>" . htmlspecialchars($env_content) . "</pre>";
} else {
    echo "<p style='color:red'>.env file does not exist!</p>";
}

// Test database connection
echo "<h3>Database Connection Test:</h3>";
if (file_exists('../.env')) {
    $env_lines = file('../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $env_vars = [];
    foreach ($env_lines as $line) {
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $env_vars[trim($key)] = trim($value);
        }
    }

    if (isset($env_vars['DB_HOST']) && isset($env_vars['DB_NAME']) && isset($env_vars['DB_USER'])) {
        try {
            $dsn = "mysql:host={$env_vars['DB_HOST']};dbname={$env_vars['DB_NAME']}";
            $pdo = new PDO($dsn, $env_vars['DB_USER'], $env_vars['DB_PASS'] ?? '');
            echo "<p style='color:green'>✓ Database connection successful</p>";
        } catch (PDOException $e) {
            echo "<p style='color:red'>✗ Database connection failed: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p style='color:red'>✗ Database configuration missing in .env</p>";
    }
} else {
    echo "<p style='color:red'>✗ Cannot test database - .env file missing</p>";
}
?>