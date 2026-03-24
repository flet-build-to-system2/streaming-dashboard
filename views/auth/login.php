<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once ROOT . '/app/Controllers/AuthController.php';
if (AuthController::isLoggedIn()) { header("Location: index.php?page=dashboard"); exit; }
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AbdouTV - تسجيل الدخول</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-page">
    <div class="orb" style="width:400px;height:400px;background:rgba(14,165,233,0.2);top:-100px;left:-100px;"></div>
    <div class="login-card">
        <div class="login-header">
            <h1>AbdouTV</h1>
            <p>سجل دخولك لإدارة منصتك</p>
        </div>
        <form action="?page=login" method="POST">
            <div class="input-group">
                <label>البريد الإلكتروني</label>
                <input type="email" name="email" required placeholder="admin@example.com">
            </div>
            <div class="input-group">
                <label>كلمة المرور</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn-login">دخول النظام</button>
        </form>
        <?php if (isset($_SESSION['login_error'])): ?>
            <p style="color: red; margin-top: 10px;"><?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>