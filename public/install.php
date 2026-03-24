<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Check if already installed
require_once '../app/Controllers/InstallController.php';
if (InstallController::isInstalled()) {
    header("Location: index.php");
    exit;
}

// Load installer routes
include '../routes/install.php';
?>

<link rel="stylesheet" href="assets/css/style.css"> <div class="install-container glass-card">
    <div class="steps-header">
        <span class="<?= $step == 1 ? 'active' : '' ?>">1. المتطلبات</span>
        <span class="<?= $step == 2 ? 'active' : '' ?>">2. قاعدة البيانات</span>
        <span class="<?= $step == 3 ? 'active' : '' ?>">3. الحساب</span>
        <span class="<?= $step == 4 ? 'active' : '' ?>">4. الإنهاء</span>
    </div>

    <?php if($step == 1): ?>
        <div class="step-content">
            <h3>فحص النظام</h3>
            <?php foreach($requirements as $label => $status): ?>
                <div class="req-item">
                    <?= $label ?>: <?= $status ? '✅' : '❌' ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if($step == 2): ?>
        <div class="step-content">
            <h3>إعداد قاعدة البيانات</h3>
            <form method="POST">
                <div class="input-group">
                    <label>اسم المضيف</label>
                    <input type="text" name="host" value="localhost" required>
                </div>
                <div class="input-group">
                    <label>اسم قاعدة البيانات</label>
                    <input type="text" name="db_name" value="streaming_db" required>
                </div>
                <div class="input-group">
                    <label>اسم المستخدم</label>
                    <input type="text" name="username" value="root" required>
                </div>
                <div class="input-group">
                    <label>كلمة المرور</label>
                    <input type="password" name="password">
                </div>
                <button type="submit" class="btn-login">اختبار الاتصال</button>
            </form>
        </div>
    <?php endif; ?>

    <?php if($step == 3): ?>
        <div class="step-content">
            <h3>إنشاء حساب المشرف</h3>
            <form method="POST" action="?step=4">
                <div class="input-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email" name="email" required>
                </div>
                <div class="input-group">
                    <label>كلمة المرور</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="btn-login">إنشاء الحساب</button>
            </form>
        </div>
    <?php endif; ?>

    <?php if($step == 4): ?>
        <div class="step-content">
            <h3>تم التثبيت بنجاح!</h3>
            <p>يمكنك الآن الوصول إلى لوحة التحكم.</p>
            <a href="index.php" class="btn-login">الدخول إلى النظام</a>
        </div>
    <?php endif; ?>

    </div>