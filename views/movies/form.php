<div class="glass-card">
    <div class="card-header">
        <h3><i class="fas fa-film"></i> <?php echo isset($movie_data) ? 'تعديل الفيلم' : 'إضافة فيلم جديد'; ?></h3>
    </div>

    <form action="?page=movies&action=<?php echo isset($movie_data) ? 'update&id=' . $movie_data['id'] : 'store'; ?>" method="POST" enctype="multipart/form-data">
        <?php if (isset($movie_data)): ?>
            <input type="hidden" name="id" value="<?php echo $movie_data['id']; ?>">
        <?php endif; ?>
        <div class="input-group">
            <label>عنوان الفيلم</label>
            <input type="text" name="title" required value="<?php echo isset($movie_data) ? htmlspecialchars($movie_data['title']) : ''; ?>">
        </div>

        <div class="stats-grid" style="grid-template-columns: 1fr 1fr;">
            <div class="input-group">
                <label>سنة الإصدار</label>
                <input type="number" name="release_year" min="1900" max="2099" value="<?php echo isset($movie_data) ? htmlspecialchars($movie_data['release_year']) : ''; ?>">
            </div>
            <div class="input-group">
                <label>بوستر الفيلم</label>
                <input type="file" name="poster" accept="image/*">
                <?php if (isset($movie_data) && $movie_data['poster']): ?>
                    <div style="margin-top: 10px;">
                        <img src="<?php echo htmlspecialchars($movie_data['poster']); ?>" alt="Current Poster" style="max-width: 100px; height: auto;">
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="input-group">
            <label>الوصف</label>
            <textarea name="description" rows="4"><?php echo isset($movie_data) ? htmlspecialchars($movie_data['description']) : ''; ?></textarea>
        </div>

        <div class="input-group">
            <label>رابط الفيديو</label>
            <input type="url" name="video_url" required value="<?php echo isset($movie_data) ? htmlspecialchars($movie_data['video_url']) : ''; ?>" placeholder="https://example.com/movie.mp4">
        </div>

        <div class="input-group">
            <label>التصنيف</label>
            <select name="category_id">
                <option value="">اختر تصنيف (اختياري)</option>
                <?php foreach($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= isset($movie_data) && $movie_data['category_id'] == $cat['id'] ? 'selected' : '' ?>><?= $cat['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-login"><?php echo isset($movie_data) ? 'تحديث الفيلم' : 'إضافة الفيلم للمكتبة'; ?></button>
            <a href="?page=movies" class="btn-secondary">إلغاء</a>
        </div>
    </form>
</div>