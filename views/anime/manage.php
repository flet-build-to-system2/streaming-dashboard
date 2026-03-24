<div class="glass-card">
    <div class="card-header">
        <h3><i class="fas fa-mask"></i> إضافة أنمي جديد</h3>
    </div>
    <form action="?page=anime&action=store" method="POST" enctype="multipart/form-data">
        <div class="stats-grid">
            <div class="input-group">
                <label>عنوان الأنمي</label>
                <input type="text" name="title" required placeholder="مثال: One Piece">
            </div>
            <div class="input-group">
                <label>الحالة</label>
                <select name="status">
                    <option value="ongoing">مستمر</option>
                    <option value="completed">مكتمل</option>
                </select>
            </div>
        </div>
        <div class="input-group">
            <label>بوستر الأنمي</label>
            <input type="file" name="poster" accept="image/*">
        </div>
        <button type="submit" class="btn-login">حفظ الأنمي</button>
    </form>
</div>

<div class="glass-card" style="margin-top: 20px;">
    <h4><i class="fas fa-plus-circle"></i> إضافة حلقة</h4>
    <form action="?page=episodes&action=add" method="POST">
        <div class="stats-grid" style="grid-template-columns: 2fr 1fr 2fr;">
            <select name="anime_id" required>
                <option value="">اختر الأنمي...</option>
                </select>
            <input type="number" name="ep_num" placeholder="رقم الحلقة" required>
            <input type="url" name="url" placeholder="رابط المشاهدة" required>
        </div>
        <button type="submit" class="btn-login" style="margin-top:10px; width:auto; padding:8px 20px;">إضافة الحلقة</button>
    </form>
</div>
<style>
    .stats-grid {
        display: grid;
        gap: 15px;
    }
    @media (max-width: 600px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
    .btn-login {
        background-color: var(--primary-color);
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 4px;
    }
    .btn-login:hover {
        background-color: var(--primary-color-hover);
    }

</style>