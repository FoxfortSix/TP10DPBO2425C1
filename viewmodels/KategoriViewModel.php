<?php
require_once 'config/Database.php';
require_once 'models/Kategori.php';

class KategoriViewModel {
    private $model;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new Kategori($db);
    }

    public function viewList() {
        return $this->model->read();
    }

    public function addKategori($nama) {
        $this->model->nama_kategori = $nama;
        return $this->model->create();
    }

    public function getKategoriById($id) {
        $this->model->id_kategori = $id;
        $this->model->getSingleKategori();
        return $this->model;
    }

    public function updateKategori($id, $nama) {
        $this->model->id_kategori = $id;
        $this->model->nama_kategori = $nama;
        return $this->model->update();
    }

    public function deleteKategori($id) {
        $this->model->id_kategori = $id;
        return $this->model->delete();
    }
}
?>