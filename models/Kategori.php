<?php
class Kategori {
    private $conn;
    private $table_name = "kategori";

    public $id_kategori;
    public $nama_kategori;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_kategori ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nama_kategori=:nama_kategori";
        $stmt = $this->conn->prepare($query);
        $this->nama_kategori = htmlspecialchars(strip_tags($this->nama_kategori));
        $stmt->bindParam(":nama_kategori", $this->nama_kategori);
        
        if($stmt->execute()) return true;
        return false;
    }

    public function getSingleKategori() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_kategori = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_kategori);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->nama_kategori = $row['nama_kategori'];
        }
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nama_kategori = :nama_kategori WHERE id_kategori = :id_kategori";
        $stmt = $this->conn->prepare($query);

        $this->nama_kategori = htmlspecialchars(strip_tags($this->nama_kategori));
        $this->id_kategori = htmlspecialchars(strip_tags($this->id_kategori));

        $stmt->bindParam(':nama_kategori', $this->nama_kategori);
        $stmt->bindParam(':id_kategori', $this->id_kategori);

        if($stmt->execute()) return true;
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_kategori = ?";
        $stmt = $this->conn->prepare($query);
        $this->id_kategori = htmlspecialchars(strip_tags($this->id_kategori));
        $stmt->bindParam(1, $this->id_kategori);

        if($stmt->execute()) return true;
        return false;
    }
}
?>