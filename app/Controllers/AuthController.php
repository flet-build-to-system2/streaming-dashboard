<?php
class AuthController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public static function isLoggedIn() {
        return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $query = "SELECT id, email, password, role FROM admins WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $admin = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $admin['password'])) {
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_id'] = $admin['id'];
                    $_SESSION['admin_email'] = $admin['email'];
                    $_SESSION['admin_role'] = $admin['role'];
                    header("Location: index.php?page=dashboard");
                    exit;
                }
            }
            // Generic error message
            $_SESSION['login_error'] = "Invalid email or password";
            header("Location: index.php?page=login");
            exit;
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time() - 3600, '/');
        header("Location: index.php?page=login");
        exit;
    }
}
?>