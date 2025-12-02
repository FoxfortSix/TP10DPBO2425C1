<?php
require_once 'config/Database.php';
require_once 'models/Peminjaman.php';
require_once 'models/Buku.php';
require_once 'models/Anggota.php';

class PeminjamanViewModel {
    private $model;
    private $bukuModel;
    private $anggotaModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new Peminjaman($db);
        $this->bukuModel = new Buku($db);
        $this->anggotaModel = new Anggota($db);
    }

    public function viewList() {
        return $this->model->read();
    }

    public function getBukuList() {
        return $this->bukuModel->read();
    }

    public function getAnggotaList() {
        return $this->anggotaModel->read();
    }

    public function addPeminjaman($id_buku, $id_anggota, $tanggal) {
        $this->model->id_buku = $id_buku;
        $this->model->id_anggota = $id_anggota;
        $this->model->tanggal_pinjam = $tanggal;
        return $this->model->create();
    }

    public function getPeminjamanById($id) {
        $this->model->id_peminjaman = $id;
        $this->model->getSinglePeminjaman();
        return $this->model;
    }

    public function updatePeminjaman($id, $id_buku, $id_anggota, $tanggal) {
        $this->model->id_peminjaman = $id;
        $this->model->id_buku = $id_buku;
        $this->model->id_anggota = $id_anggota;
        $this->model->tanggal_pinjam = $tanggal;
        return $this->model->update();
    }

    public function deletePeminjaman($id) {
        $this->model->id_peminjaman = $id;
        return $this->model->delete();
    }
}
?>