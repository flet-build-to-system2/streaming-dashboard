<?php
class AdSetting {
    private $conn;
    private $table_name = "ad_settings";

    public $id;
    public $network_name;
    public $settings_json;
    public $is_active;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getActive() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE is_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET network_name=:network_name, settings_json=:settings_json, is_active=:is_active";
        $stmt = $this->conn->prepare($query);

        $this->network_name = htmlspecialchars(strip_tags($this->network_name));
        $this->settings_json = $this->settings_json; // JSON
        $this->is_active = htmlspecialchars(strip_tags($this->is_active));

        $stmt->bindParam(":network_name", $this->network_name);
        $stmt->bindParam(":settings_json", $this->settings_json);
        $stmt->bindParam(":is_active", $this->is_active);

        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET settings_json=:settings_json, is_active=:is_active WHERE network_name=:network_name";
        $stmt = $this->conn->prepare($query);

        $this->network_name = htmlspecialchars(strip_tags($this->network_name));
        $this->settings_json = $this->settings_json;
        $this->is_active = htmlspecialchars(strip_tags($this->is_active));

        $stmt->bindParam(":network_name", $this->network_name);
        $stmt->bindParam(":settings_json", $this->settings_json);
        $stmt->bindParam(":is_active", $this->is_active);

        return $stmt->execute();
    }
}