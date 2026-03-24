<?php
class ChannelController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        $channel = new Channel($this->db);
        $channels = $channel->getAll();
        include '../views/channels/index.php';
    }

    public function create() {
        $categories = $this->getCategories();
        include '../views/channels/form.php';
    }

    public function edit() {
        if (isset($_GET['id'])) {
            $channel = new Channel($this->db);
            $channel->id = $_GET['id'];
            $stmt = $channel->getById();
            $channel_data = $stmt->fetch(PDO::FETCH_ASSOC);
            $categories = $this->getCategories();
            include '../views/channels/form.php';
        }
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $channel = new Channel($this->db);
            $channel->name = $_POST['name'];
            $channel->logo = $this->uploadFile('logo', 'channels');
            $channel->m3u_link = $_POST['m3u_link'];
            $channel->category_id = $_POST['category_id'];
            $channel->status = $_POST['status'];
            if ($channel->create()) {
                header("Location: index.php?page=channels&status=success");
            }
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
            $channel = new Channel($this->db);
            $channel->id = $_GET['id'];
            $channel->name = $_POST['name'];
            if (!empty($_FILES['logo']['name'])) {
                $channel->logo = $this->uploadFile('logo', 'channels');
            }
            $channel->m3u_link = $_POST['m3u_link'];
            $channel->category_id = $_POST['category_id'];
            $channel->status = $_POST['status'];
            if ($channel->update()) {
                header("Location: index.php?page=channels&status=updated");
            }
        }
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $channel = new Channel($this->db);
            $channel->id = $_GET['id'];
            if ($channel->delete()) {
                header("Location: index.php?page=channels&status=deleted");
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
            $filename = $dir[0] . "_" . time() . "_" . uniqid() . "." . $ext;
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