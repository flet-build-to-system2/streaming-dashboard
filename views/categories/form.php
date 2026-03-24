<div class="glass-card">
    <div class="card-header">
        <h3><i class="fas fa-tags"></i> إدارة التصنيفات</h3>
        <button class="btn-primary" onclick="showAddForm()">إضافة تصنيف جديد</button>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>النوع</th>
                    <th>تاريخ الإنشاء</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?php echo htmlspecialchars($category['name']); ?></td>
                    <td><?php echo htmlspecialchars($category['type']); ?></td>
                    <td><?php echo htmlspecialchars($category['created_at']); ?></td>
                    <td>
                        <button class="btn-edit" onclick="editCategory(<?php echo $category['id']; ?>)">تعديل</button>
                        <button class="btn-delete" onclick="deleteCategory(<?php echo $category['id']; ?>)">حذف</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add/Edit Form Modal -->
<div id="categoryModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h4 id="modalTitle">إضافة تصنيف جديد</h4>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <form id="categoryForm" method="POST">
            <input type="hidden" name="id" id="categoryId">
            <div class="input-group">
                <label for="name">اسم التصنيف</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="input-group">
                <label for="type">النوع</label>
                <select id="type" name="type" required>
                    <option value="general">عام</option>
                    <option value="movie">أفلام</option>
                    <option value="channel">قنوات</option>
                    <option value="anime">أنمي</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-primary">حفظ</button>
                <button type="button" class="btn-secondary" onclick="closeModal()">إلغاء</button>
            </div>
        </form>
    </div>
</div>

<script>
function showAddForm() {
    document.getElementById('modalTitle').textContent = 'إضافة تصنيف جديد';
    document.getElementById('categoryForm').action = '?page=categories&action=store';
    document.getElementById('categoryId').value = '';
    document.getElementById('name').value = '';
    document.getElementById('type').value = 'general';
    document.getElementById('categoryModal').style.display = 'block';
}

function editCategory(id) {
    // Fetch category data and populate form
    fetch(`?page=categories&action=get&id=${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalTitle').textContent = 'تعديل التصنيف';
            document.getElementById('categoryForm').action = '?page=categories&action=update&id=' + id;
            document.getElementById('categoryId').value = data.id;
            document.getElementById('name').value = data.name;
            document.getElementById('type').value = data.type;
            document.getElementById('categoryModal').style.display = 'block';
        });
}

function deleteCategory(id) {
    if (confirm('هل أنت متأكد من حذف هذا التصنيف؟')) {
        window.location.href = `?page=categories&action=delete&id=${id}`;
    }
}

function closeModal() {
    document.getElementById('categoryModal').style.display = 'none';
}
</script>
<style>
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
</style>