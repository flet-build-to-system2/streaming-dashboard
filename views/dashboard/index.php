<div class="dashboard-welcome">
    <h2>مرحباً بك مجدداً في AbdouTV</h2>
    <p>إليك ملخص سريع لما يحدث في منصتك اليوم.</p>
</div>

<div class="stats-grid">
    <div class="glass-card stat-item">
        <div class="stat-icon" style="background: rgba(14, 165, 233, 0.2); color: #0EA5E9;">
            <i class="fas fa-tv"></i>
        </div>
        <div class="stat-info">
            <h3><?= $stats['channels'] ?></h3>
            <span>قناة مباشرة</span>
        </div>
    </div>

    <div class="glass-card stat-item">
        <div class="stat-icon" style="background: rgba(139, 92, 246, 0.2); color: #8B5CF6;">
            <i class="fas fa-film"></i>
        </div>
        <div class="stat-info">
            <h3><?= $stats['movies'] ?></h3>
            <span>فيلم متاح</span>
        </div>
    </div>

    <div class="glass-card stat-item">
        <div class="stat-icon" style="background: rgba(245, 158, 11, 0.2); color: #F59E0B;">
            <i class="fas fa-mask"></i>
        </div>
        <div class="stat-info">
            <h3><?= $stats['anime'] ?></h3>
            <span>سلسلة أنمي</span>
        </div>
    </div>

    <div class="glass-card stat-item">
        <div class="stat-icon" style="background: rgba(16, 185, 129, 0.2); color: #10B981;">
            <i class="fas fa-play-circle"></i>
        </div>
        <div class="stat-info">
            <h3><?= $stats['episodes'] ?></h3>
            <span>حلقة أنمي</span>
        </div>
    </div>
</div>

<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }
    .stat-item {
        display: flex;
        align-items: center;
        gap: 20px;
        transition: transform 0.3s ease;
    }
    .stat-item:hover {
        transform: translateY(-5px);
    }
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .stat-info h3 {
        margin: 0;
        font-size: 1.8rem;
        color: var(--text-primary);
    }
    .stat-info span {
        font-size: 0.9rem;
        color: #64748B;
    }
    .badge-channel {
        background: rgba(14, 165, 233, 0.2);
        color: #0EA5E9;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.8rem;
    }
    .badge-movie {
        background: rgba(139, 92, 246, 0.2);
        color: #8B5CF6;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.8rem;
    }
    .badge-anime {
        background: rgba(245, 158, 11, 0.2);
        color: #F59E0B;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.8rem;
    }
</style>
<div class="glass-card" style="margin-top: 30px;">
    <h4><i class="fas fa-history"></i> آخر الإضافات</h4>
    <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
        <thead>
            <tr style="text-align: right; border-bottom: 1px solid var(--glass-border);">
                <th style="padding: 10px;">النوع</th>
                <th>العنوان / الاسم</th>
                <th>التاريخ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($latest['channels'] as $item): ?>
            <tr>
                <td style="padding: 12px;"><span class="badge-channel">قناة</span></td>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($item['created_at']))); ?></td>
            </tr>
            <?php endforeach; ?>
            <?php foreach ($latest['movies'] as $item): ?>
            <tr>
                <td style="padding: 12px;"><span class="badge-movie">فيلم</span></td>
                <td><?php echo htmlspecialchars($item['title']); ?></td>
                <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($item['created_at']))); ?></td>
            </tr>
            <?php endforeach; ?>
            <?php foreach ($latest['anime'] as $item): ?>
            <tr>
                <td style="padding: 12px;"><span class="badge-anime">أنمي</span></td>
                <td><?php echo htmlspecialchars($item['title']); ?></td>
                <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($item['created_at']))); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>