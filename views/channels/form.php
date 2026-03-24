<div class="glass-card">
    <div class="card-header">
        <h3><i class="fas fa-tv"></i> <?php echo isset($channel_data) ? 'تعديل القناة' : 'إضافة قناة جديدة'; ?></h3>
    </div>

    <form action="?page=channels&action=<?php echo isset($channel_data) ? 'update&id=' . $channel_data['id'] : 'store'; ?>" method="POST" enctype="multipart/form-data">
        <?php if (isset($channel_data)): ?>
            <input type="hidden" name="id" value="<?php echo $channel_data['id']; ?>">
        <?php endif; ?>
        <div class="stats-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="input-group">
                <label>اسم القناة</label>
                <input type="text" name="name" required placeholder="مثال: beIN Sports 1" value="<?php echo isset($channel_data) ? htmlspecialchars($channel_data['name']) : ''; ?>">
            </div>

            <div class="input-group">
                <label>التصنيف</label>
                <select name="category_id" required>
                    <?php foreach($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?php echo isset($channel_data) && $channel_data['category_id'] == $cat['id'] ? 'selected' : ''; ?>><?= $cat['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="input-group">
            <label>رابط البث (M3U8 / MP4)</label>
            <input type="url" name="m3u_link" required placeholder="https://example.com/stream.m3u8" value="<?php echo isset($channel_data) ? htmlspecialchars($channel_data['m3u_link']) : ''; ?>">
        </div>

        <div class="input-group">
            <label>حالة القناة</label>
            <select name="status" required>
                <option value="active" <?php echo isset($channel_data) && $channel_data['status'] == 'active' ? 'selected' : ''; ?>>نشط</option>
                <option value="inactive" <?php echo isset($channel_data) && $channel_data['status'] == 'inactive' ? 'selected' : ''; ?>>غير نشط</option>
            </select>
        </div>

        <div class="input-group">
            <label>شعار القناة (Logo)</label>
            <input type="file" name="logo" accept="image/*">
            <small>يفضل استخدام صور بصيغة PNG أو WebP</small>
            <?php if (isset($channel_data) && $channel_data['logo']): ?>
                <div style="margin-top: 10px;">
                    <img src="<?php echo htmlspecialchars($channel_data['logo']); ?>" alt="Current Logo" style="max-width: 100px; height: auto;">
                </div>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-login"><?php echo isset($channel_data) ? 'تحديث القناة' : 'حفظ القناة'; ?></button>
            <a href="?page=channels" class="btn-secondary">إلغاء</a>
        </div>
    </form>
</div>