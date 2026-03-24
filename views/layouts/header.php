<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AbdouTV - لوحة التحكم</title>
    <link rel="icon" href="assets/img/icon.jpg" type="image/jpeg">
    <link rel="apple-touch-icon" href="assets/img/icon.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <aside class="sidebar">
        <h2>AbdouTV</h2>
        <nav>
            <a href="?page=dashboard" class="nav-link"><i class="fas fa-tachometer-alt"></i> لوحة التحكم</a>
            <a href="?page=categories" class="nav-link"><i class="fas fa-tags"></i> التصنيفات</a>
            <a href="?page=channels" class="nav-link"><i class="fas fa-tv"></i> القنوات</a>
            <a href="?page=movies" class="nav-link"><i class="fas fa-film"></i> الأفلام</a>
            <a href="?page=anime" class="nav-link"><i class="fas fa-mask"></i> الأنمي</a>
            <a href="?page=ads" class="nav-link"><i class="fas fa-ads"></i> الإعلانات</a>
            <a href="?page=settings" class="nav-link"><i class="fas fa-cog"></i> الإعدادات</a>
        </nav>
    </aside>
    <div class="topbar">
        <div class="search-box">
            <input type="text" placeholder="البحث...">
            <i class="fas fa-search"></i>
        </div>
        <div class="topbar-actions">
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <button class="icon-btn"><i class="fas fa-expand"></i></button>
            <div class="admin-profile">
                <span><?php echo $_SESSION['admin_email'] ?? 'Admin'; ?></span>
                <a href="?page=logout" class="logout-btn"><i class="fas fa-sign-out-alt"></i> خروج</a>
            </div>
        </div>
    </div>
    <main class="main-content" style="margin-top: var(--topbar-h);">