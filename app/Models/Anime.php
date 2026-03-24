<?php
class Anime {
    private $conn;
    private $table_name = "anime";

    public $id;
    public $title;
    public $description;
    public $release_year;
    public $poster;
    public $category_id;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT a.*, cat.name as category_name,
                         (SELECT COUNT(*) FROM episodes e WHERE e.anime_id = a.id) as episode_count
                  FROM " . $this->table_name . " a
                  LEFT JOIN categories cat ON a.category_id = cat.id
                  ORDER BY a.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET title=:title, description=:description, poster=:poster, category_id=:category_id, status=:status";
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title ?? ''));
        $this->description = htmlspecialchars(strip_tags($this->description ?? ''));
        $this->release_year = $this->release_year !== null ? htmlspecialchars(strip_tags($this->release_year)) : null;
        $this->poster = htmlspecialchars(strip_tags($this->poster ?? ''));
        $this->category_id = $this->category_id !== null ? htmlspecialchars(strip_tags($this->category_id)) : null;
        $this->status = htmlspecialchars(strip_tags($this->status ?? 'ongoing'));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":poster", $this->poster);
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
        $query = "UPDATE " . $this->table_name . " SET title=:title, description=:description, poster=:poster, category_id=:category_id, status=:status WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title ?? ''));
        $this->description = htmlspecialchars(strip_tags($this->description ?? ''));
        $this->release_year = $this->release_year !== null ? htmlspecialchars(strip_tags($this->release_year)) : null;
        $this->poster = htmlspecialchars(strip_tags($this->poster ?? ''));
        $this->category_id = $this->category_id !== null ? htmlspecialchars(strip_tags($this->category_id)) : null;
        $this->status = htmlspecialchars(strip_tags($this->status ?? 'ongoing'));
        $this->id = htmlspecialchars(strip_tags($this->id ?? ''));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":poster", $this->poster);
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