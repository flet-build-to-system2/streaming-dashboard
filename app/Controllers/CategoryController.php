<?php
class CategoryController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        $category = new Category($this->db);
        $categories = $category->getAll();
        include '../views/categories/form.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category = new Category($this->db);
            $category->name = $_POST['name'];
            $category->type = $_POST['type'];
            if ($category->create()) {
                header("Location: index.php?page=categories&status=success");
            }
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
            $category = new Category($this->db);
            $category->id = $_GET['id'];
            $category->name = $_POST['name'];
            $category->type = $_POST['type'];
            if ($category->update()) {
                header("Location: index.php?page=categories&status=updated");
            }
        }
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $category = new Category($this->db);
            $category->id = $_GET['id'];
            if ($category->delete()) {
                header("Location: index.php?page=categories&status=deleted");
            }
        }
    }

    public function get() {
        if (isset($_GET['id'])) {
            $category = new Category($this->db);
            $category->id = $_GET['id'];
            $stmt = $category->getById();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }
}
?>