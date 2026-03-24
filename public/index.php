<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

// Define root path
define('ROOT', dirname(__DIR__));

// Autoload controllers and models (simple folder-based loader)
foreach (glob(__DIR__ . '/../app/Controllers/*.php') as $controllerFile) {
    require_once $controllerFile;
}
foreach (glob(__DIR__ . '/../app/Models/*.php') as $modelFile) {
    require_once $modelFile;
}

// API route support (AbdouTV integration sends ?route=api&endpoint=...)
if (isset($_GET['route']) && $_GET['route'] === 'api') {
    include '../routes/api.php';
    exit;
}

// Check if installed
if (!InstallController::isInstalled()) {
    header("Location: install.php");
    exit;
}

// Load database
require_once '../config/database.php';
$database = new Database();
$db = $database->getConnection();

if (!$db) {
    die("فشل في الاتصال بقاعدة البيانات. تحقق من إعدادات قاعدة البيانات.");
}

// Handle login POST
if (isset($_GET['page']) && $_GET['page'] === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new AuthController($db);
    $auth->login();
}

// Check authentication
if (!AuthController::isLoggedIn()) {
    if (isset($_GET['page']) && $_GET['page'] === 'login') {
        include '../views/auth/login.php';
        exit;
    } else {
        header("Location: index.php?page=login");
        exit;
    }
}

// Handle logout
if (isset($_GET['page']) && $_GET['page'] === 'logout') {
    $auth = new AuthController(null);
    $auth->logout();
}

// Include header
include '../views/layouts/header.php';

// Load routes
include '../routes/web.php';

// Include footer
include '../views/layouts/footer.php';
?>
