<?php
class Episode {
    private $conn;
    private $table_name = "episodes";

    public $id;
    public $anime_id;
    public $episode_number;
    public $title;
    public $video_url;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT e.*, a.title as anime_title FROM " . $this->table_name . " e LEFT JOIN anime a ON e.anime_id = a.id ORDER BY e.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET anime_id=:anime_id, episode_number=:episode_number, title=:title, video_url=:video_url";
        $stmt = $this->conn->prepare($query);

        $this->anime_id = htmlspecialchars(strip_tags($this->anime_id));
        $this->episode_number = htmlspecialchars(strip_tags($this->episode_number));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->video_url = htmlspecialchars(strip_tags($this->video_url));

        $stmt->bindParam(":anime_id", $this->anime_id);
        $stmt->bindParam(":episode_number", $this->episode_number);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":video_url", $this->video_url);

        return $stmt->execute();
    }

    public function getByAnimeId($anime_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE anime_id = :anime_id ORDER BY episode_number ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":anime_id", $anime_id);
        $stmt->execute();
        return $stmt;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }
}