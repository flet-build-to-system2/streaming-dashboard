<?php
class InstallController {
    public static function isInstalled() {
        return file_exists('../.env') && strpos(file_get_contents('../.env'), 'INSTALLED=true') !== false;
    }

    public function requirements() {
        $requirements = [
            'PHP Version >= 7.4' => version_compare(PHP_VERSION, '7.4.0', '>='),
            'PDO Extension' => extension_loaded('pdo'),
            'OpenSSL Extension' => extension_loaded('openssl'),
            'Writable Root' => is_writable('../'),
            'Writable .env' => is_writable('../.env') || !file_exists('../.env'),
        ];
        return $requirements;
    }

    public function testConnection($host, $db_name, $username, $password) {
        try {
            $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
            return ['success' => true, 'message' => 'Connection successful'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function install($db_config, $admin_config) {
        try {
            // Create database connection
            $dsn = "mysql:host={$db_config['host']};dbname={$db_config['db_name']}";
            $pdo = new PDO($dsn, $db_config['username'], $db_config['password']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Run SQL schema
            $sql_file = __DIR__ . '/../../install.sql';
            if (!file_exists($sql_file)) {
                throw new Exception("ملف install.sql غير موجود: " . $sql_file);
            }

            $sql = file_get_contents($sql_file);
            if ($sql === false) {
                throw new Exception("فشل في قراءة ملف install.sql");
            }

            // Split SQL into individual statements and execute them
            $statements = array_filter(array_map('trim', explode(';', $sql)));
            foreach ($statements as $statement) {
                if (!empty($statement)) {
                    $pdo->exec($statement);
                }
            }

            // Create admin user (update if exists, insert if not)
            $hashed_password = password_hash($admin_config['password'], PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("
                INSERT INTO admins (email, password, role)
                VALUES (?, ?, 'super_admin')
                ON DUPLICATE KEY UPDATE
                password = VALUES(password),
                role = VALUES(role)
            ");
            $stmt->execute([$admin_config['email'], $hashed_password]);

            // Write .env file
            $env_content = "DB_HOST={$db_config['host']}\n";
            $env_content .= "DB_NAME={$db_config['db_name']}\n";
            $env_content .= "DB_USER={$db_config['username']}\n";
            $env_content .= "DB_PASS={$db_config['password']}\n";
            $env_content .= "APP_NAME=AbdouTV\n";
            $env_content .= "APP_URL=\n";
            $env_content .= "MAINTENANCE_MODE=false\n";
            $env_content .= "INSTALLED=true\n";

            $env_file = __DIR__ . '/../../.env';
            $result = file_put_contents($env_file, $env_content);
            if ($result === false) {
                throw new Exception("فشل في كتابة ملف .env - تحقق من أذونات الكتابة");
            }

            return ['success' => true];

        } catch (PDOException $e) {
            error_log("Database error during install: " . $e->getMessage());
            return ['success' => false, 'message' => 'خطأ في قاعدة البيانات: ' . $e->getMessage()];
        } catch (Exception $e) {
            error_log("Install error: " . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
?>