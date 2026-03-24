<?php
class AnimeController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        $anime = new Anime($this->db);
        $animes = $anime->getAll();
        include '../views/anime/index.php';
    }

    public function create() {
        $categories = $this->getCategories();
        include '../views/anime/form.php';
    }

    public function edit() {
        if (isset($_GET['id'])) {
            $anime = new Anime($this->db);
            $anime->id = $_GET['id'];
            $stmt = $anime->getById();
            $anime_data = $stmt->fetch(PDO::FETCH_ASSOC);
            $categories = $this->getCategories();
            include '../views/anime/form.php';
        }
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $anime = new Anime($this->db);
            $anime->title = $_POST['title'] ?? '';
            $anime->description = $_POST['description'] ?? '';
            $anime->release_year = $_POST['release_year'] ?? null;
            $anime->poster = $this->uploadFile('poster', 'anime');
            $anime->category_id = isset($_POST['category_id']) ? $_POST['category_id'] : null;
            $anime->status = $_POST['status'] ?? 'ongoing';
            if ($anime->create()) {
                header("Location: index.php?page=anime&status=success");
            }
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
            $anime = new Anime($this->db);
            $anime->id = $_GET['id'];
            $anime->title = $_POST['title'] ?? '';
            $anime->description = $_POST['description'] ?? '';
            $anime->release_year = $_POST['release_year'] ?? null;
            if (!empty($_FILES['poster']['name'])) {
                $anime->poster = $this->uploadFile('poster', 'anime');
            }
            $anime->category_id = isset($_POST['category_id']) ? $_POST['category_id'] : null;
            $anime->status = $_POST['status'] ?? 'ongoing';
            if ($anime->update()) {
                header("Location: index.php?page=anime&status=updated");
            }
        }
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $anime = new Anime($this->db);
            $anime->id = $_GET['id'];
            if ($anime->delete()) {
                header("Location: index.php?page=anime&status=deleted");
            }
        }
    }

    public function episodes() {
        if (isset($_GET['id'])) {
            $anime_id = $_GET['id'];
            $episode = new Episode($this->db);
            $episodes = $episode->getByAnimeId($anime_id);
            include '../views/anime/episodes.php';
        }
    }

    public function add_episode() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $episode = new Episode($this->db);
            $episode->anime_id = $_POST['anime_id'];
            $episode->episode_number = $_POST['episode_number'];
            $episode->title = $_POST['title'];
            $episode->video_url = $_POST['video_url'];
            if ($episode->create()) {
                header("Location: index.php?page=anime&action=episodes&id=" . $_POST['anime_id'] . "&status=success");
            }
        }
    }

    public function delete_episode() {
        if (isset($_GET['id'])) {
            $episode = new Episode($this->db);
            $episode->id = $_GET['id'];
            if ($episode->delete()) {
                header("Location: index.php?page=anime&action=episodes&id=" . $_GET['anime_id'] . "&status=deleted");
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
            $filename = "ani_" . time() . "_" . uniqid() . "." . $ext;
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