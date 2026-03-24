<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *"); // للسماح بالوصول من تطبيقات الموبايل

require_once '../config/database.php';
require_once '../app/Models/Channel.php';
require_once '../app/Models/Movie.php';
require_once '../app/Models/Anime.php';
require_once '../app/Models/Episode.php';
require_once '../app/Models/AdSetting.php';

$database = new Database();
$db = $database->getConnection();

$endpoint = $_GET['endpoint'] ?? '';
$response = ["status" => "error", "message" => "Endpoint not found"];

switch ($endpoint) {
    case 'settings':
        $query = "SELECT setting_key, setting_value FROM app_settings";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $settings = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        
        $response = [
            "status" => "success",
            "data" => [
                "maintenance_mode" => $settings['maintenance_mode'] ?? "0",
                "latest_version_code" => $settings['latest_version_code'] ?? "1",
                "update_url" => $settings['update_url'] ?? "",
                "update_message" => $settings['update_message'] ?? "",
                "force_update" => $settings['force_update'] ?? "0",
                "enable_channels" => $settings['enable_channels'] ?? "1",
                "enable_movies" => $settings['enable_movies'] ?? "1",
                "enable_anime" => $settings['enable_anime'] ?? "1"
            ]
        ];
        break;

    case 'categories':
        $query = "SELECT * FROM categories ORDER BY name ASC";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $response = ["status" => "success", "data" => $stmt->fetchAll(PDO::FETCH_ASSOC)];
        break;

    case 'channels':
        $channel = new Channel($db);
        $stmt = $channel->getAll();
        $response = ["status" => "success", "data" => $stmt->fetchAll(PDO::FETCH_ASSOC)];
        break;

    case 'movies':
        $movie = new Movie($db);
        $stmt = $movie->getAll();
        $response = ["status" => "success", "data" => $stmt->fetchAll(PDO::FETCH_ASSOC)];
        break;

    case 'anime':
        $anime = new Anime($db);
        $stmt = $anime->getAll();
        $animes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Add episodes for each anime
        foreach ($animes as &$animeItem) {
            $episode = new Episode($db);
            $episodesStmt = $episode->getByAnimeId($animeItem['id']);
            $animeItem['anime_episodes'] = $episodesStmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
        $response = ["status" => "success", "data" => $animes];
        break;

    case 'ads':
        // جلب الشبكات الإعلانية النشطة فقط
        $query = "SELECT network_name, settings_json FROM ad_settings WHERE is_active = 1";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $response = ["status" => "success", "data" => $stmt->fetchAll(PDO::FETCH_ASSOC)];
        break;

    case 'check-update':
        // منطق التحقق من التحديثات
        $query = "SELECT setting_key, setting_value FROM app_settings WHERE setting_key LIKE 'update_%' OR setting_key = 'force_update'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $settings = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        
        $response = [
            "status" => "success",
            "data" => [
                "update_available" => $settings['update_enabled'] ?? "0",
                "version" => $settings['update_version'] ?? "1.0.0",
                "url" => $settings['update_url'] ?? "",
                "message" => $settings['update_message'] ?? "",
                "force_update" => $settings['force_update'] ?? "0"
            ]
        ];
        break;
}

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);