<div class="glass-card">
    <div class="card-header">
        <h3><i class="fas fa-play-circle"></i> حلقات الأنمي: <?php echo htmlspecialchars($anime_title ?? 'غير محدد'); ?></h3>
        <button class="btn-primary" onclick="showAddEpisodeForm()">إضافة حلقة جديدة</button>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>رقم الحلقة</th>
                    <th>العنوان</th>
                    <th>تاريخ الإضافة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($episodes as $episode): ?>
                <tr>
                    <td><?php echo htmlspecialchars($episode['episode_number']); ?></td>
                    <td><?php echo htmlspecialchars($episode['title'] ?? 'حلقة ' . $episode['episode_number']); ?></td>
                    <td><?php echo htmlspecialchars($episode['created_at']); ?></td>
                    <td>
                        <button class="btn-edit" onclick="editEpisode(<?php echo $episode['id']; ?>)">تعديل</button>
                        <button class="btn-delete" onclick="deleteEpisode(<?php echo $episode['id']; ?>)">حذف</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="form-actions" style="margin-top: 20px;">
        <a href="?page=anime" class="btn-secondary">العودة للأنمي</a>
    </div>
</div>

<!-- Add Episode Form Modal -->
<div id="episodeModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 id="episodeModalTitle">إضافة حلقة جديدة</h4>
            <span class="close" onclick="closeEpisodeModal()">&times;</span>
        </div>
        <form id="episodeForm" method="POST">
            <input type="hidden" name="anime_id" value="<?php echo $_GET['id']; ?>">
            <div class="input-group">
                <label for="episode_number">رقم الحلقة</label>
                <input type="number" id="episode_number" name="episode_number" min="1" required>
            </div>
            <div class="input-group">
                <label for="title">عنوان الحلقة (اختياري)</label>
                <input type="text" id="title" name="title">
            </div>
            <div class="input-group">
                <label for="video_url">رابط الفيديو</label>
                <input type="url" id="video_url" name="video_url" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-primary">حفظ</button>
                <button type="button" class="btn-secondary" onclick="closeEpisodeModal()">إلغاء</button>
            </div>
        </form>
    </div>
</div>

<script>
function showAddEpisodeForm() {
    document.getElementById('episodeModalTitle').textContent = 'إضافة حلقة جديدة';
    document.getElementById('episodeForm').action = '?page=anime&action=add_episode';
    document.getElementById('episode_number').value = '';
    document.getElementById('title').value = '';
    document.getElementById('video_url').value = '';
    document.getElementById('episodeModal').style.display = 'block';
}

function editEpisode(id) {
    // Fetch episode data and populate form
    fetch(`?page=anime&action=get_episode&id=${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('episodeModalTitle').textContent = 'تعديل الحلقة';
            document.getElementById('episodeForm').action = '?page=anime&action=update_episode&id=' + id;
            document.getElementById('episode_number').value = data.episode_number;
            document.getElementById('title').value = data.title || '';
            document.getElementById('video_url').value = data.video_url;
            document.getElementById('episodeModal').style.display = 'block';
        });
}

function deleteEpisode(id) {
    if (confirm('هل أنت متأكد من حذف هذه الحلقة؟')) {
        window.location.href = `?page=anime&action=delete_episode&id=${id}&anime_id=<?php echo $_GET['id']; ?>`;
    }
}

function closeEpisodeModal() {
    document.getElementById('episodeModal').style.display = 'none';
}
</script>
<style>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}
.modal-content {
    background-color: var(--bg-card);
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    max-width: 90%;
}
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}
.close {
    font-size: 24px;
    cursor: pointer;
}
.input-group {
    margin-bottom: 15px;
}
.input-group label {
    display: block;
    margin-bottom: 5px;
}
.input-group input {
    width: 100%;
    padding: 8px;
    border: 1px solid var(--border-color);
    border-radius: 4px;
}
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
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
.btn-secondary {
    background-color: var(--btn-secondary-bg);
    color: var(--btn-secondary-text);
    padding: 8px 16px;
    border-radius: 4px;
    border: none;
    cursor: pointer;
}
.btn-primary:hover {
    background-color: var(--btn-primary-bg-hover);
}
.btn-secondary:hover {
    background-color: var(--btn-secondary-bg-hover);
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

</style>