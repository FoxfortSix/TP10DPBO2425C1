<?php
class Buku {
    private $conn;
    private $table_name = "buku";

    public $id_buku;
    public $judul_buku;
    public $pengarang;
    public $id_kategori;
    public $id_penerbit;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        // Menggunakan JOIN untuk mengambil nama kategori dan penerbit
        $query = "SELECT b.id_buku, b.judul_buku, b.pengarang, b.id_kategori, b.id_penerbit, 
                         k.nama_kategori, p.nama_penerbit 
                  FROM " . $this->table_name . " b
                  LEFT JOIN kategori k ON b.id_kategori = k.id_kategori
                  LEFT JOIN penerbit p ON b.id_penerbit = p.id_penerbit
                  ORDER BY b.id_buku DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET judul_buku=:judul, pengarang=:pengarang, id_kategori=:idk, id_penerbit=:idp";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":judul", $this->judul_buku);
        $stmt->bindParam(":pengarang", $this->pengarang);
        $stmt->bindParam(":idk", $this->id_kategori);
        $stmt->bindParam(":idp", $this->id_penerbit);
        
        if($stmt->execute()) return true;
        return false;
    }

    public function getSingleBuku() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_buku = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_buku);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->judul_buku = $row['judul_buku'];
            $this->pengarang = $row['pengarang'];
            $this->id_kategori = $row['id_kategori'];
            $this->id_penerbit = $row['id_penerbit'];
        }
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET judul_buku=:judul, pengarang=:pengarang, id_kategori=:idk, id_penerbit=:idp 
                  WHERE id_buku=:id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":judul", $this->judul_buku);
        $stmt->bindParam(":pengarang", $this->pengarang);
        $stmt->bindParam(":idk", $this->id_kategori);
        $stmt->bindParam(":idp", $this->id_penerbit);
        $stmt->bindParam(":id", $this->id_buku);

        if($stmt->execute()) return true;
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_buku = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_buku);
        if($stmt->execute()) return true;
        return false;
    }
}
?>