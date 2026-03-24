<div class="glass-card">
    <div class="card-header">
        <h3><i class="fas fa-tv"></i> إدارة القنوات</h3>
        <a href="?page=channels&action=create" class="btn-primary">إضافة قناة جديدة</a>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>التصنيف</th>
                    <th>الحالة</th>
                    <th>تاريخ الإنشاء</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($channels as $channel): ?>
                <tr>
                    <td>
                        <div class="channel-info">
                            <?php if ($channel['logo']): ?>
                                <img src="<?php echo htmlspecialchars($channel['logo']); ?>" alt="Logo" class="channel-logo">
                            <?php endif; ?>
                            <span><?php echo htmlspecialchars($channel['name']); ?></span>
                        </div>
                    </td>
                    <td><?php echo htmlspecialchars($channel['category_name'] ?? 'غير مصنف'); ?></td>
                    <td>
                        <span class="status-badge <?php echo $channel['status'] === 'active' ? 'active' : 'inactive'; ?>">
                            <?php echo $channel['status'] === 'active' ? 'نشط' : 'غير نشط'; ?>
                        </span>
                    </td>
                    <td><?php echo htmlspecialchars($channel['created_at']); ?></td>
                    <td>
                        <a href="?page=channels&action=edit&id=<?php echo $channel['id']; ?>" class="btn-edit">تعديل</a>
                        <button class="btn-delete" onclick="deleteChannel(<?php echo $channel['id']; ?>)">حذف</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function deleteChannel(id) {
    if (confirm('هل أنت متأكد من حذف هذه القناة؟')) {
        window.location.href = `?page=channels&action=delete&id=${id}`;
    }
}
</script>

<style>
.channel-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.channel-logo {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    object-fit: cover;
}

.status-badge {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
}

.status-badge.active {
    background: rgba(16, 185, 129, 0.1);
    color: #10B981;
}

.status-badge.inactive {
    background: rgba(239, 68, 68, 0.1);
    color: #EF4444;
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