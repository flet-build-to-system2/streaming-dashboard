<?php
class Movie {
    private $conn;
    private $table_name = "movies";

    public $id;
    public $title;
    public $description;
    public $release_year;
    public $poster;
    public $video_url;
    public $category_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT m.*, cat.name as category_name FROM " . $this->table_name . " m LEFT JOIN categories cat ON m.category_id = cat.id ORDER BY m.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET title=:title, description=:description, release_year=:release_year, poster=:poster, video_url=:video_url, category_id=:category_id";
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->release_year = htmlspecialchars(strip_tags($this->release_year));
        $this->poster = htmlspecialchars(strip_tags($this->poster));
        $this->video_url = htmlspecialchars(strip_tags($this->video_url));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":release_year", $this->release_year);
        $stmt->bindParam(":poster", $this->poster);
        $stmt->bindParam(":video_url", $this->video_url);
        $stmt->bindParam(":category_id", $this->category_id);

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
        $query = "UPDATE " . $this->table_name . " SET title=:title, description=:description, release_year=:release_year, poster=:poster, video_url=:video_url, category_id=:category_id WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->release_year = htmlspecialchars(strip_tags($this->release_year));
        $this->poster = htmlspecialchars(strip_tags($this->poster));
        $this->video_url = htmlspecialchars(strip_tags($this->video_url));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":release_year", $this->release_year);
        $stmt->bindParam(":poster", $this->poster);
        $stmt->bindParam(":video_url", $this->video_url);
        $stmt->bindParam(":category_id", $this->category_id);
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