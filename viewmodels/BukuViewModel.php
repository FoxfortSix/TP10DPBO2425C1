<?php
require_once 'config/Database.php';
require_once 'models/Buku.php';
require_once 'models/Kategori.php';
require_once 'models/Penerbit.php';

class BukuViewModel {
    private $model;
    private $kategoriModel;
    private $penerbitModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new Buku($db);
        $this->kategoriModel = new Kategori($db);
        $this->penerbitModel = new Penerbit($db);
    }

    public function viewList() {
        return $this->model->read();
    }

    // Fungsi tambahan untuk mengambil data Dropdown
    public function getKategoriList() {
        return $this->kategoriModel->read();
    }

    public function getPenerbitList() {
        return $this->penerbitModel->read();
    }

    public function addBuku($judul, $pengarang, $id_kategori, $id_penerbit) {
        $this->model->judul_buku = $judul;
        $this->model->pengarang = $pengarang;
        $this->model->id_kategori = $id_kategori;
        $this->model->id_penerbit = $id_penerbit;
        return $this->model->create();
    }

    public function getBukuById($id) {
        $this->model->id_buku = $id;
        $this->model->getSingleBuku();
        return $this->model;
    }

    public function updateBuku($id, $judul, $pengarang, $id_kategori, $id_penerbit) {
        $this->model->id_buku = $id;
        $this->model->judul_buku = $judul;
        $this->model->pengarang = $pengarang;
        $this->model->id_kategori = $id_kategori;
        $this->model->id_penerbit = $id_penerbit;
        return $this->model->update();
    }

    public function deleteBuku($id) {
        $this->model->id_buku = $id;
        return $this->model->delete();
    }
}
?>