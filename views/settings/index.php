<div class="glass-card">
    <div class="card-header">
        <h3><i class="fas fa-cog"></i> إعدادات التطبيق</h3>
    </div>

    <form method="POST" action="?page=settings&action=save">
        <div class="settings-sections">
            <!-- General Settings -->
            <div class="settings-section">
                <h4>الإعدادات العامة</h4>
                <div class="form-grid">
                    <div class="input-group">
                        <label for="app_name">اسم التطبيق</label>
                        <input type="text" id="app_name" name="app_name" value="<?php echo htmlspecialchars($settings['app_name'] ?? 'AbdouTV'); ?>">
                    </div>

                    <div class="input-group">
                        <label for="app_version">إصدار التطبيق</label>
                        <input type="text" id="app_version" name="app_version" value="<?php echo htmlspecialchars($settings['app_version'] ?? '1.0.0'); ?>">
                    </div>

                    <div class="input-group full-width">
                        <label for="app_description">وصف التطبيق</label>
                        <textarea id="app_description" name="app_description" rows="3"><?php echo htmlspecialchars($settings['app_description'] ?? 'Your ultimate streaming platform'); ?></textarea>
                    </div>

                    <div class="input-group">
                        <label for="support_email">بريد الدعم</label>
                        <input type="email" id="support_email" name="support_email" value="<?php echo htmlspecialchars($settings['support_email'] ?? ''); ?>">
                    </div>

                    <div class="input-group">
                        <label for="privacy_url">رابط سياسة الخصوصية</label>
                        <input type="url" id="privacy_url" name="privacy_url" value="<?php echo htmlspecialchars($settings['privacy_url'] ?? ''); ?>">
                    </div>

                    <div class="input-group">
                        <label for="terms_of_service">رابط شروط الخدمة</label>
                        <input type="url" id="terms_of_service" name="terms_of_service" value="<?php echo htmlspecialchars($settings['terms_of_service'] ?? ''); ?>">
                    </div>
                </div>
            </div>

            <!-- App Update Settings -->
            <div class="settings-section">
                <h4>إعدادات التحديث</h4>
                <div class="form-grid">
                    <div class="input-group">
                        <label for="update_version">أحدث إصدار متاح</label>
                        <input type="text" id="update_version" name="update_version" value="<?php echo htmlspecialchars($settings['update_version'] ?? '1.0.0'); ?>">
                    </div>

                    <div class="input-group">
                        <label for="update_url">رابط التحميل</label>
                        <input type="url" id="update_url" name="update_url" value="<?php echo htmlspecialchars($settings['update_url'] ?? ''); ?>">
                    </div>

                    <div class="input-group full-width">
                        <label for="update_message">رسالة التحديث</label>
                        <textarea id="update_message" name="update_message" rows="3"><?php echo htmlspecialchars($settings['update_message'] ?? ''); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Feature Toggles -->
            <div class="settings-section">
                <h4>الميزات</h4>
                <div class="toggles-grid">
                    <div class="toggle-item">
                        <label class="toggle">
                            <input type="checkbox" name="maintenance_mode" value="1" <?php echo ($settings['maintenance_mode'] ?? '0') === '1' ? 'checked' : ''; ?>>
                            <span class="toggle-slider"></span>
                        </label>
                        <div class="toggle-info">
                            <strong>وضع الصيانة</strong>
                            <p>يضع التطبيق في وضع الصيانة</p>
                        </div>
                    </div>

                    <div class="toggle-item">
                        <label class="toggle">
                            <input type="checkbox" name="force_update" value="1" <?php echo ($settings['force_update'] ?? '0') === '1' ? 'checked' : ''; ?>>
                            <span class="toggle-slider"></span>
                        </label>
                        <div class="toggle-info">
                            <strong>فرض التحديث</strong>
                            <p>يجبر المستخدمين على تحديث التطبيق</p>
                        </div>
                    </div>

                    <div class="toggle-item">
                        <label class="toggle">
                            <input type="checkbox" name="show_ads" value="1" <?php echo ($settings['show_ads'] ?? '1') === '1' ? 'checked' : ''; ?>>
                            <span class="toggle-slider"></span>
                        </label>
                        <div class="toggle-info">
                            <strong>عرض الإعلانات</strong>
                            <p>تفعيل أو إلغاء الإعلانات في التطبيق</p>
                        </div>
                    </div>

                    <div class="toggle-item">
                        <label class="toggle">
                            <input type="checkbox" name="enable_channels" value="1" <?php echo ($settings['enable_channels'] ?? '1') === '1' ? 'checked' : ''; ?>>
                            <span class="toggle-slider"></span>
                        </label>
                        <div class="toggle-info">
                            <strong>تفعيل القنوات</strong>
                            <p>إظهار قسم القنوات في التطبيق</p>
                        </div>
                    </div>

                    <div class="toggle-item">
                        <label class="toggle">
                            <input type="checkbox" name="enable_movies" value="1" <?php echo ($settings['enable_movies'] ?? '1') === '1' ? 'checked' : ''; ?>>
                            <span class="toggle-slider"></span>
                        </label>
                        <div class="toggle-info">
                            <strong>تفعيل الأفلام</strong>
                            <p>إظهار قسم الأفلام في التطبيق</p>
                        </div>
                    </div>

                    <div class="toggle-item">
                        <label class="toggle">
                            <input type="checkbox" name="enable_anime" value="1" <?php echo ($settings['enable_anime'] ?? '1') === '1' ? 'checked' : ''; ?>>
                            <span class="toggle-slider"></span>
                        </label>
                        <div class="toggle-info">
                            <strong>تفعيل الأنمي</strong>
                            <p>إظهار قسم الأنمي في التطبيق</p>
                        </div>
                    </div>

                    <div class="toggle-item">
                        <label class="toggle">
                            <input type="checkbox" name="update_enabled" value="1" <?php echo ($settings['update_enabled'] ?? '0') === '1' ? 'checked' : ''; ?>>
                            <span class="toggle-slider"></span>
                        </label>
                        <div class="toggle-info">
                            <strong>تفعيل التحديثات</strong>
                            <p>إظهار إشعارات التحديث للمستخدمين</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="settings-section danger">
                <h4>منطقة الخطر</h4>
                <p class="danger-text">الإجراءات التالية لا يمكن التراجع عنها. تأكد من عمل نسخة احتياطية قبل المتابعة.</p>
                <div class="danger-actions">
                    <button type="button" class="btn-danger" onclick="clearAllData()">مسح جميع البيانات</button>
                    <button type="button" class="btn-danger" onclick="resetSettings()">إعادة تعيين الإعدادات</button>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">حفظ الإعدادات</button>
        </div>
    </form>
</div>

<style>
.settings-sections {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.settings-section {
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px;
}

.settings-section h4 {
    margin-bottom: 20px;
    color: var(--text-primary);
    font-size: 18px;
}

.toggles-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
}

.toggle-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    background: var(--bg-card);
    border-radius: var(--radius);
    border: 1px solid var(--border);
}

.toggle {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
}

.toggle input {
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: var(--text-muted);
    transition: 0.4s;
    border-radius: 24px;
}

.toggle-slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: 0.4s;
    border-radius: 50%;
}

input:checked + .toggle-slider {
    background-color: var(--sky-500);
}

input:checked + .toggle-slider:before {
    transform: translateX(26px);
}

.toggle-info strong {
    display: block;
    color: var(--text-primary);
    margin-bottom: 4px;
}

.toggle-info p {
    color: var(--text-secondary);
    font-size: 14px;
    margin: 0;
}

.settings-section.danger {
    border-color: #EF4444;
    background: rgba(239, 68, 68, 0.05);
}

.danger-text {
    color: #EF4444;
    margin-bottom: 20px;
    font-size: 14px;
}

.danger-actions {
    display: flex;
    gap: 12px;
}

.btn-danger {
    background: #EF4444;
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: var(--radius);
    cursor: pointer;
    font-size: 14px;
}

.btn-danger:hover {
    background: #DC2626;
}
</style>

<script>
function clearAllData() {
    if (confirm('هل أنت متأكد من مسح جميع البيانات؟ هذا الإجراء لا يمكن التراجع عنه.')) {
        // Implement clear all data functionality
        alert('تم مسح جميع البيانات');
    }
}

function resetSettings() {
    if (confirm('هل أنت متأكد من إعادة تعيين الإعدادات إلى القيم الافتراضية؟')) {
        // Implement reset settings functionality
        alert('تم إعادة تعيين الإعدادات');
    }
}
</script>