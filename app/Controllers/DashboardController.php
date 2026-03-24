<?php
class DashboardController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getStats() {
        $stats = [];

        // إجمالي القنوات
        $stats['channels'] = $this->db->query("SELECT COUNT(*) FROM channels")->fetchColumn();

        // إجمالي الأفلام
        $stats['movies'] = $this->db->query("SELECT COUNT(*) FROM movies")->fetchColumn();

        // إجمالي الأنمي والحلقات
        $stats['anime'] = $this->db->query("SELECT COUNT(*) FROM anime")->fetchColumn();
        $stats['episodes'] = $this->db->query("SELECT COUNT(*) FROM episodes")->fetchColumn();

        // إجمالي التصنيفات
        $stats['categories'] = $this->db->query("SELECT COUNT(*) FROM categories")->fetchColumn();

        return $stats;
    }

    public function getLatestAdditions() {
        $latest = [];

        // آخر 3 قنوات مضافة
        $stmt = $this->db->query("SELECT id, name, created_at FROM channels ORDER BY created_at DESC LIMIT 3");
        $latest['channels'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // آخر 3 أفلام مضافة
        $stmt = $this->db->query("SELECT id, title, created_at FROM movies ORDER BY created_at DESC LIMIT 3");
        $latest['movies'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // آخر 3 أنمي مضافة
        $stmt = $this->db->query("SELECT id, title, created_at FROM anime ORDER BY created_at DESC LIMIT 3");
        $latest['anime'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $latest;
    }
}