<?php
// Installer routes — handles all 4 steps + AJAX

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Session already started in public/install.php
// session_start();

$step = $_GET['step'] ?? 1;
$controller = new InstallController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($step == 2 && isset($_POST['ajax'])) {
        // Test database connection
        $result = $controller->testConnection($_POST['host'], $_POST['db_name'], $_POST['username'], $_POST['password']);
        echo json_encode($result);
        exit;
    } elseif ($step == 4 && isset($_POST['ajax'])) {
        // Perform installation
        $db_config = $_SESSION['db_data'];
        $admin_config = $_SESSION['admin_data'];
        $result = $controller->install($db_config, $admin_config);

        echo json_encode($result);
        exit;
    }
}

// Handle step navigation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_GET['ajax'])) {
    if ($step == 1) {
        header("Location: install.php?step=2");
    } elseif ($step == 2) {
        $_SESSION['db_data'] = $_POST;
        header("Location: install.php?step=3");
    } elseif ($step == 3) {
        $_SESSION['admin_data'] = $_POST;
        header("Location: install.php?step=4");
    }
    exit;
}

// Include step views
include '../views/install/layout.php';
?>