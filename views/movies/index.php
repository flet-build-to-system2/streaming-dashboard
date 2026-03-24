<div class="glass-card">
    <div class="card-header">
        <h3><i class="fas fa-film"></i> إدارة الأفلام</h3>
        <a href="?page=movies&action=create" class="btn btn-primary">إضافة فيلم جديد</a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>العنوان</th>
                    <th>التصنيف</th>
                    <th>سنة الإصدار</th>
                    <th>تاريخ الإنشاء</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($movies as $movie): ?>
                <tr>
                    <td>
                        <div class="movie-info">
                            <?php if ($movie['poster']): ?>
                                <img src="<?php echo htmlspecialchars($movie['poster']); ?>" alt="Poster" class="movie-poster">
                            <?php endif; ?>
                            <span><?php echo htmlspecialchars($movie['title']); ?></span>
                        </div>
                    </td>
                    <td><?php echo htmlspecialchars($movie['category_name'] ?? 'غير مصنف'); ?></td>
                    <td><?php echo htmlspecialchars($movie['release_year'] ?? 'غير محدد'); ?></td>
                    <td><?php echo htmlspecialchars($movie['created_at']); ?></td>
                    <td class="action-buttons">
                        <a href="?page=movies&action=edit&id=<?php echo $movie['id']; ?>" class="btn btn-secondary">تعديل</a>
                        <button class="btn btn-danger" onclick="deleteMovie(<?php echo $movie['id']; ?>)">حذف</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function deleteMovie(id) {
    if (confirm('هل أنت متأكد من حذف هذا الفيلم؟')) {
        window.location.href = `?page=movies&action=delete&id=${id}`;
    }
}
</script>
<style>

    .movie-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .movie-poster {
        width: 50px;
        height: 70px;
        border-radius: 8px;
        object-fit: cover;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .action-buttons .btn {
        padding: 5px 10px;
        font-size: 14px;
    }
	.action-buttons .btn-secondary {
    	background-color: var(--btn-secondary-bg);
    	color: var(--btn-secondary-text);
    	padding: 5px 10px;
    	font-size: 14px;
	}

	.action-buttons .btn-danger {
    	background: linear-gradient(135deg, #f83838, #c70202);
    	color: white;
    	border: none;
    	border-radius: 10px;
    	padding: 5px 10px;
    	font-size: 14px;
	}

    .action-buttons .btn-secondary:hover {
        background-color: var(--btn-secondary-bg-hover);
    }

    .action-buttons .btn-danger:hover {
        background-color: var(--btn-danger-bg-hover);
    }
    



</style>