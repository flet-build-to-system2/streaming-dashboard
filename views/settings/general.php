<div class="glass-card">
    <div class="card-header">
        <h3><i class="fas fa-cog"></i> إعدادات المنصة والتحديثات</h3>
    </div>
    <form action="?page=settings&action=update" method="POST">
        <div class="input-section">
            <h4><i class="fas fa-info-circle"></i> معلومات التطبيق</h4>
            <div class="input-group">
                <label>اسم التطبيق</label>
                <input type="text" name="app_name" value="<?= $settings['app_name'] ?? 'AbdouTV' ?>">
            </div>
            <div class="input-group">
                <label>رابط سياسة الخصوصية</label>
                <input type="url" name="privacy_policy" value="<?= $settings['privacy_policy'] ?? '' ?>">
            </div>
        </div>

        <hr style="border: 0.5px solid var(--glass-border); margin: 25px 0;">

        <div class="input-section">
            <h4><i class="fas fa-sync"></i> نظام التحديث الذكي</h4>
            <div class="stats-grid">
                <div class="input-group">
                    <label>إصدار التطبيق الحالي (Version Code)</label>
                    <input type="text" name="update_version" value="<?= $settings['update_version'] ?? '1.0.0' ?>">
                </div>
                <div class="input-group">
                    <label>رابط التحديث (Direct Link / Play Store)</label>
                    <input type="url" name="update_url" value="<?= $settings['update_url'] ?? '' ?>">
                </div>
            </div>
            <div class="input-group" style="flex-direction: row; align-items: center; gap: 10px;">
                <input type="checkbox" name="force_update" <?= ($settings['force_update'] ?? '0') == '1' ? 'checked' : '' ?>>
                <label style="margin-bottom: 0;">تفعيل التحديث الإجباري (Force Update)</label>
            </div>
        </div>

        <button type="submit" class="btn-login" style="margin-top: 20px;">حفظ كافة التغييرات</button>
    </form>
</div>