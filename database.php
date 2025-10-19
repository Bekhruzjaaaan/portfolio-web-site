<?php
// ============================================
// config/database.php
// Ma'lumotlar bazasiga ulanish
// ============================================

class Database {
    private $host = "localhost";
    private $db_name = "bloguz321";
    private $username = "bloguz321";
    private $password = "bloguz321";
    public $conn;

    // Ma'lumotlar bazasiga ulanish
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $exception) {
            echo json_encode([
                'success' => false,
                'message' => 'Ma\'lumotlar bazasiga ulanishda xatolik: ' . $exception->getMessage()
            ]);
            exit();
        }

        return $this->conn;
    }
}
?>