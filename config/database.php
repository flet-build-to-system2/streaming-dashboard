<?php
class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    public function __construct() {
        $this->loadEnv();
    }

    private function loadEnv() {
        $env_file = __DIR__ . '/../.env';
        if (file_exists($env_file)) {
            $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) {
                    continue;
                }
                if (strpos($line, '=') !== false) {
                    list($name, $value) = explode('=', $line, 2);
                    $name = trim($name);
                    $value = trim($value);
                    if ($name === 'DB_HOST') $this->host = $value;
                    elseif ($name === 'DB_NAME') $this->db_name = $value;
                    elseif ($name === 'DB_USER') $this->username = $value;
                    elseif ($name === 'DB_PASS') $this->password = $value;
                }
            }
        } else {
            $this->host = 'localhost';
            $this->db_name = 'streaming_db';
            $this->username = 'root';
            $this->password = '';
        }
    }

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8mb4");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            error_log("Database connection error: " . $exception->getMessage());
            die("خطأ في الاتصال بقاعدة البيانات: " . $exception->getMessage() . "<br>تحقق من إعدادات قاعدة البيانات في ملف .env");
        }
        return $this->conn;
    }
}