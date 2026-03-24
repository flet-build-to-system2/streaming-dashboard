<?php
class MovieController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        $movie = new Movie($this->db);
        $movies = $movie->getAll();
        include '../views/movies/index.php';
    }

    public function create() {
        $categories = $this->getCategories();
        include '../views/movies/form.php';
    }

    public function edit() {
        if (isset($_GET['id'])) {
            $movie = new Movie($this->db);
            $movie->id = $_GET['id'];
            $stmt = $movie->getById();
            $movie_data = $stmt->fetch(PDO::FETCH_ASSOC);
            $categories = $this->getCategories();
            include '../views/movies/form.php';
        }
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $movie = new Movie($this->db);
            $movie->title = $_POST['title'];
            $movie->description = $_POST['description'];
            $movie->release_year = $_POST['release_year'];
            $movie->poster = $this->uploadFile('poster', 'movies');
            $movie->video_url = $_POST['video_url'];
            $movie->category_id = $_POST['category_id'];
            if ($movie->create()) {
                header("Location: index.php?page=movies&status=success");
            }
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
            $movie = new Movie($this->db);
            $movie->id = $_GET['id'];
            $movie->title = $_POST['title'];
            $movie->description = $_POST['description'];
            $movie->release_year = $_POST['release_year'];
            if (!empty($_FILES['poster']['name'])) {
                $movie->poster = $this->uploadFile('poster', 'movies');
            }
            $movie->video_url = $_POST['video_url'];
            $movie->category_id = $_POST['category_id'];
            if ($movie->update()) {
                header("Location: index.php?page=movies&status=updated");
            }
        }
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $movie = new Movie($this->db);
            $movie->id = $_GET['id'];
            if ($movie->delete()) {
                header("Location: index.php?page=movies&status=deleted");
            }
        }
    }

    private function uploadFile($field, $dir) {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] == 0) {
            $upload_dir = "../public/uploads/$dir/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            $ext = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
            $filename = "mov_" . time() . "_" . uniqid() . "." . $ext;
            move_uploaded_file($_FILES[$field]['tmp_name'], $upload_dir . $filename);
            return "uploads/$dir/$filename";
        }
        return null;
    }

    private function getCategories() {
        $query = "SELECT id, name FROM categories ORDER BY name ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>