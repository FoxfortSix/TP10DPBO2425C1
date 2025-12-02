<?php
class Penerbit {
    private $conn;
    private $table_name = "penerbit";

    public $id_penerbit;
    public $nama_penerbit;
    public $kota_penerbit;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_penerbit ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nama_penerbit=:nama, kota_penerbit=:kota";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":nama", $this->nama_penerbit);
        $stmt->bindParam(":kota", $this->kota_penerbit);
        
        if($stmt->execute()) return true;
        return false;
    }

    public function getSinglePenerbit() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_penerbit = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_penerbit);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->nama_penerbit = $row['nama_penerbit'];
            $this->kota_penerbit = $row['kota_penerbit'];
        }
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nama_penerbit=:nama, kota_penerbit=:kota WHERE id_penerbit=:id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nama", $this->nama_penerbit);
        $stmt->bindParam(":kota", $this->kota_penerbit);
        $stmt->bindParam(":id", $this->id_penerbit);

        if($stmt->execute()) return true;
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_penerbit = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_penerbit);
        if($stmt->execute()) return true;
        return false;
    }
}
?>