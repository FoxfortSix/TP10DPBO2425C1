<?php
class Peminjaman {
    private $conn;
    private $table_name = "peminjaman";

    public $id_peminjaman;
    public $id_buku;
    public $id_anggota;
    public $tanggal_pinjam;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        // JOIN ke buku dan anggota
        $query = "SELECT pm.id_peminjaman, pm.tanggal_pinjam, pm.id_buku, pm.id_anggota,
                         b.judul_buku, a.nama_anggota
                  FROM " . $this->table_name . " pm
                  LEFT JOIN buku b ON pm.id_buku = b.id_buku
                  LEFT JOIN anggota a ON pm.id_anggota = a.id_anggota
                  ORDER BY pm.id_peminjaman DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET id_buku=:idb, id_anggota=:ida, tanggal_pinjam=:tgl";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":idb", $this->id_buku);
        $stmt->bindParam(":ida", $this->id_anggota);
        $stmt->bindParam(":tgl", $this->tanggal_pinjam);
        
        if($stmt->execute()) return true;
        return false;
    }

    public function getSinglePeminjaman() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_peminjaman = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_peminjaman);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->id_buku = $row['id_buku'];
            $this->id_anggota = $row['id_anggota'];
            $this->tanggal_pinjam = $row['tanggal_pinjam'];
        }
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET id_buku=:idb, id_anggota=:ida, tanggal_pinjam=:tgl 
                  WHERE id_peminjaman=:id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":idb", $this->id_buku);
        $stmt->bindParam(":ida", $this->id_anggota);
        $stmt->bindParam(":tgl", $this->tanggal_pinjam);
        $stmt->bindParam(":id", $this->id_peminjaman);

        if($stmt->execute()) return true;
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_peminjaman = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_peminjaman);
        if($stmt->execute()) return true;
        return false;
    }
}
?>