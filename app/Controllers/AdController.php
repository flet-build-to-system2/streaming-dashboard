<?php
class AdController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        $adSettings = $this->getAdSettings();
        require_once ROOT . '/views/ads/settings.php';
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?page=ads');
            exit;
        }

        $settings = [
            // AdMob settings
            'admob_app_id' => $_POST['admob_app_id'] ?? '',
            'admob_banner_id' => $_POST['admob_banner_id'] ?? '',
            'admob_interstitial_id' => $_POST['admob_interstitial_id'] ?? '',
            'admob_rewarded_id' => $_POST['admob_rewarded_id'] ?? '',

            // AppLovin settings
            'applovin_sdk_key' => $_POST['applovin_sdk_key'] ?? '',
            'applovin_banner_id' => $_POST['applovin_banner_id'] ?? '',
            'applovin_interstitial_id' => $_POST['applovin_interstitial_id'] ?? '',
            'applovin_rewarded_id' => $_POST['applovin_rewarded_id'] ?? '',

            // Unity Ads settings
            'unity_game_id' => $_POST['unity_game_id'] ?? '',
            'unity_banner_id' => $_POST['unity_banner_id'] ?? '',
            'unity_interstitial_id' => $_POST['unity_interstitial_id'] ?? '',
            'unity_rewarded_id' => $_POST['unity_rewarded_id'] ?? '',

            // IronSource settings
            'ironsource_app_key' => $_POST['ironsource_app_key'] ?? '',
            'ironsource_banner_id' => $_POST['ironsource_banner_id'] ?? '',
            'ironsource_interstitial_id' => $_POST['ironsource_interstitial_id'] ?? '',
            'ironsource_rewarded_id' => $_POST['ironsource_rewarded_id'] ?? '',

            // Ad configuration
            'ad_network_priority' => $_POST['ad_network_priority'] ?? 'admob',
            'banner_interval' => $_POST['banner_interval'] ?? '5',
            'interstitial_interval' => $_POST['interstitial_interval'] ?? '10',
            'rewarded_interval' => $_POST['rewarded_interval'] ?? '15'
        ];

        $this->saveAdSettings($settings);

        $_SESSION['success'] = 'تم حفظ إعدادات الإعلانات بنجاح';
        header('Location: ?page=ads');
        exit;
    }

    private function getAdSettings() {
        $stmt = $this->db->query("SELECT setting_key, setting_value FROM ad_settings");
        $settings = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        return $settings;
    }

    private function saveAdSettings($settings) {
        $this->db->beginTransaction();

        try {
            foreach ($settings as $key => $value) {
                $stmt = $this->db->prepare("
                    INSERT INTO ad_settings (setting_key, setting_value)
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