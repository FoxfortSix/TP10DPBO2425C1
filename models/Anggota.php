<?php
class Anggota {
    private $conn;
    private $table_name = "anggota";

    public $id_anggota;
    public $nama_anggota;
    public $nomor_telepon;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_anggota ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET nama_anggota=:nama, nomor_telepon=:telp";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":nama", $this->nama_anggota);
        $stmt->bindParam(":telp", $this->nomor_telepon);
        
        if($stmt->execute()) return true;
        return false;
    }

    public function getSingleAnggota() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_anggota = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_anggota);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->nama_anggota = $row['nama_anggota'];
            $this->nomor_telepon = $row['nomor_telepon'];
        }
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nama_anggota=:nama, nomor_telepon=:telp WHERE id_anggota=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nama", $this->nama_anggota);
        $stmt->bindParam(":telp", $this->nomor_telepon);
        $stmt->bindParam(":id", $this->id_anggota);
        if($stmt->execute()) return true;
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_anggota = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_anggota);
        if($stmt->execute()) return true;
        return false;
    }
}
?>