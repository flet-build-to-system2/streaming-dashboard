<?php
class Channel {
    private $conn;
    private $table_name = "channels";

    public $id;
    public $name;
    public $logo;
    public $m3u_link;
    public $category_id;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT c.*, cat.name as category_name FROM " . $this->table_name . " c LEFT JOIN categories cat ON c.category_id = cat.id ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, logo=:logo, m3u_link=:m3u_link, category_id=:category_id, status=:status";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->logo = htmlspecialchars(strip_tags($this->logo));
        $this->m3u_link = htmlspecialchars(strip_tags($this->m3u_link));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->status = htmlspecialchars(strip_tags($this->status));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":logo", $this->logo);
        $stmt->bindParam(":m3u_link", $this->m3u_link);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":status", $this->status);

        return $stmt->execute();
    }

    public function getById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name=:name, logo=:logo, m3u_link=:m3u_link, category_id=:category_id, status=:status WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->logo = htmlspecialchars(strip_tags($this->logo));
        $this->m3u_link = htmlspecialchars(strip_tags($this->m3u_link));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":logo", $this->logo);
        $stmt->bindParam(":m3u_link", $this->m3u_link);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }
}