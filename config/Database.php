<?php
class Database {
    private $host = "localhost";
    private $db_name = "db_perpustakaan_mvvm"; // Pastikan nama DB sesuai yang kamu buat
    private $username = "root";
    private $password = ""; // Kosongkan jika pakai XAMPP default, atau isi jika ada password
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            // Menggunakan PDO untuk koneksi yang lebih aman dan support OOP
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>