<div class="glass-card">
    <div class="card-header">
        <h3><i class="fas fa-mask"></i> <?php echo isset($anime_data) ? 'تعديل الأنمي' : 'إضافة أنمي جديد'; ?></h3>
    </div>

    <form action="?page=anime&action=<?php echo isset($anime_data) ? 'update&id=' . $anime_data['id'] : 'store'; ?>" method="POST" enctype="multipart/form-data">
        <?php if (isset($anime_data)): ?>
            <input type="hidden" name="id" value="<?php echo $anime_data['id']; ?>">
        <?php endif; ?>
        <div class="input-group">
            <label>عنوان الأنمي</label>
            <input type="text" name="title" required value="<?php echo isset($anime_data) ? htmlspecialchars($anime_data['title']) : ''; ?>">
        </div>

        <div class="stats-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="input-group">
                <label>سنة الإصدار</label>
                <input type="number" name="release_year" min="1900" max="2099" value="<?php echo isset($anime_data) ? htmlspecialchars($anime_data['release_year']) : ''; ?>">
            </div>
            <div class="input-group">
                <label>الحالة</label>
                <select name="status">
                    <option value="ongoing" <?php echo isset($anime_data) && $anime_data['status'] == 'ongoing' ? 'selected' : ''; ?>>مستمر</option>
                    <option value="completed" <?php echo isset($anime_data) && $anime_data['status'] == 'completed' ? 'selected' : ''; ?>>مكتمل</option>
                    <option value="upcoming" <?php echo isset($anime_data) && $anime_data['status'] == 'upcoming' ? 'selected' : ''; ?>>قادم</option>
                </select>
            </div>
        </div>

        <div class="input-group">
            <label>بوستر الأنمي</label>
            <input type="file" name="poster" accept="image/*">
            <?php if (isset($anime_data) && $anime_data['poster']): ?>
                <div style="margin-top: 10px;">
                    <img src="<?php echo htmlspecialchars($anime_data['poster']); ?>" alt="Current Poster" style="max-width: 100px; height: auto;">
                </div>
            <?php endif; ?>
        </div>

        <div class="input-group">
            <label>الوصف</label>
            <textarea name="description" rows="4"><?php echo isset($anime_data) ? htmlspecialchars($anime_data['description']) : ''; ?></textarea>
        </div>

        <div class="input-group">
            <label>التصنيف</label>
            <select name="category_id">
                <option value="">اختر تصنيف (اختياري)</option>
                <?php foreach($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= isset($anime_data) && $anime_data['category_id'] == $cat['id'] ? 'selected' : '' ?>><?= $cat['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-login"><?php echo isset($anime_data) ? 'تحديث الأنمي' : 'إضافة الأنمي'; ?></button>
            <a href="?page=anime" class="btn-secondary">إلغاء</a>
        </div>
    </form>
</div>