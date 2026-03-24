<div class="step-content">
    <h3>فحص النظام</h3>
    <p>تحقق من توافق النظام مع متطلبات AbdouTV</p>

    <div class="debug-info">
        <a href="server-info.php" target="_blank" class="debug-link">🔍 عرض معلومات الخادم التفصيلية</a>
        <a href="validate-install.php" target="_blank" class="debug-link">✅ التحقق من صحة التثبيت</a>
    </div>

    <div class="requirements-list">
        <?php
        $requirements = [
            'PHP Version >= 7.4' => version_compare(PHP_VERSION, '7.4.0', '>='),
            'PDO Extension' => extension_loaded('pdo'),
            'PDO MySQL Extension' => extension_loaded('pdo_mysql'),
            'OpenSSL Extension' => extension_loaded('openssl'),
            'MBString Extension' => extension_loaded('mbstring'),
            'JSON Extension' => extension_loaded('json'),
            'Writable Root Directory' => is_writable('../'),
            'Writable .env File' => is_writable('../.env') || !file_exists('../.env'),
        ];

        $all_passed = true;
        foreach ($requirements as $label => $status) {
            $all_passed = $all_passed && $status;
            echo "<div class='req-item " . ($status ? 'passed' : 'failed') . "'>";
            echo "<span class='req-label'>$label</span>";
            echo "<span class='req-status'>" . ($status ? '✅' : '❌') . "</span>";
            echo "</div>";
        }
        ?>
    </div>

    <?php if ($all_passed): ?>
        <div class="step-actions">
            <a href="?step=2" class="btn-next">التالي: إعداد قاعدة البيانات</a>
        </div>
    <?php else: ?>
        <div class="error-message">
            يرجى إصلاح المشاكل أعلاه قبل المتابعة.
        </div>
    <?php endif; ?>
</div>