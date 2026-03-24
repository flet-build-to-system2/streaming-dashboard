<?php
class SettingsController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        $settings = $this->getAllSettings();
        require_once ROOT . '/views/settings/index.php';
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?page=settings');
            exit;
        }

        $settings = [
            'app_name' => $_POST['app_name'] ?? 'AbdouTV',
            'app_version' => $_POST['app_version'] ?? '1.0.0',
            'app_description' => $_POST['app_description'] ?? '',
            'support_email' => $_POST['support_email'] ?? '',
            'privacy_url' => $_POST['privacy_url'] ?? '',
            'terms_of_service' => $_POST['terms_of_service'] ?? '',
            'update_version' => $_POST['update_version'] ?? '1.0.0',
            'update_url' => $_POST['update_url'] ?? '',
            'update_message' => $_POST['update_message'] ?? '',
            'maintenance_mode' => isset($_POST['maintenance_mode']) ? '1' : '0',
            'force_update' => isset($_POST['force_update']) ? '1' : '0',
            'show_ads' => isset($_POST['show_ads']) ? '1' : '1',
            'enable_channels' => isset($_POST['enable_channels']) ? '1' : '1',
            'enable_movies' => isset($_POST['enable_movies']) ? '1' : '1',
            'enable_anime' => isset($_POST['enable_anime']) ? '1' : '1',
            'update_enabled' => isset($_POST['update_enabled']) ? '1' : '0'
        ];

        $this->saveSettings($settings);

        $_SESSION['success'] = 'تم حفظ الإعدادات بنجاح';
        header('Location: ?page=settings');
        exit;
    }

    private function getAllSettings() {
        $stmt = $this->db->query("SELECT setting_key, setting_value FROM app_settings");
        $settings = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        return $settings;
    }

    private function saveSettings($settings) {
        $this->db->beginTransaction();

        try {
            foreach ($settings as $key => $value) {
                $stmt = $this->db->prepare("
                    INSERT INTO app_settings (setting_key, setting_value)
                    VALUES (?, ?)
                    ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)
                ");
                $stmt->execute([$key, $value]);
            }

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}
?>