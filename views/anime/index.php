<div class="glass-card">
    <div class="card-header">
        <h3><i class="fas fa-mask"></i> إدارة الأنمي</h3>
        <a href="?page=anime&action=create" class="btn-primary">إضافة أنمي جديد</a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>العنوان</th>
                    <th>الحالة</th>
                    <th>عدد الحلقات</th>
                    <th>تاريخ الإنشاء</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($animes as $anime): ?>
                <tr>
                    <td>
                        <div class="anime-info">
                            <?php if ($anime['poster']): ?>
                                <img src="<?php echo htmlspecialchars($anime['poster']); ?>" alt="Poster" class="anime-poster">
                            <?php endif; ?>
                            <span><?php echo htmlspecialchars($anime['title']); ?></span>
                        </div>
                    </td>
                    <td>
                        <span class="status-badge <?php echo $anime['status']; ?>">
                            <?php
                            switch ($anime['status']) {
                                case 'ongoing': echo 'مستمر'; break;
                                case 'completed': echo 'مكتمل'; break;
                                case 'upcoming': echo 'قادم'; break;
                            }
                            ?>
                        </span>
                    </td>
                    <td><?php echo $anime['episode_count'] ?? 0; ?> حلقة</td>
                    <td><?php echo htmlspecialchars($anime['created_at']); ?></td>
                    <td>
                        <a href="?page=anime&action=episodes&id=<?php echo $anime['id']; ?>" class="btn-episodes">الحلقات</a>
                        <a href="?page=anime&action=edit&id=<?php echo $anime['id']; ?>" class="btn-edit">تعديل</a>
                        <button class="btn-delete" onclick="deleteAnime(<?php echo $anime['id']; ?>)">حذف</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function deleteAnime(id) {
    if (confirm('هل أنت متأكد من حذف هذا الأنمي؟ سيتم حذف جميع الحلقات المرتبطة به.')) {
        window.location.href = `?page=anime&action=delete&id=${id}`;
    }
}
</script>

<style>
.anime-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.anime-poster {
    width: 50px;
    height: 70px;
    border-radius: 8px;
    object-fit: cover;
}

.status-badge {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
}

.status-badge.ongoing {
    background: rgba(245, 158, 11, 0.1);
    color: #F59E0B;
}

.status-badge.completed {
    background: rgba(16, 185, 129, 0.1);
    color: #10B981;
}

.status-badge.upcoming {
    background: rgba(139, 92, 246, 0.1);
    color: #8B5CF6;
}

.btn-episodes {
    background: var(--sky-100);
    color: var(--sky-600);
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 12px;
    margin-right: 4px;
}

.btn-episodes:hover {
    background: var(--sky-200);
}
.btn-edit {
    background-color: var(--btn-secondary-bg);
    color: var(--btn-secondary-text);
    padding: 5px 10px;
    font-size: 14px;
}

.btn-delete {
    background: linear-gradient(135deg, #f83838, #c70202);
    color: white;
    border: none;
    border-radius: 10px;
    padding: 5px 10px;
    font-size: 14px;
}
.btn-edit:hover {
    background-color: var(--btn-secondary-bg-hover);
}
.btn-delete:hover {
    background-color: var(--btn-danger-bg-hover);
}
.btn-primary {
    background: linear-gradient(135deg, #38BDF8, #0284C7);
    color: white;
    border: none;
    padding: 12px;
    width: 15%;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    font-size: 16px;
    transition: transform 0.2s;
}
.btn-primary:hover {
    background-color: var(--btn-primary-bg-hover);
}
</style>