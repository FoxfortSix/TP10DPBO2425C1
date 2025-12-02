<?php
require_once 'config/Database.php';
require_once 'models/Anggota.php';

class AnggotaViewModel {
    private $model;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new Anggota($db);
    }

    public function viewList() {
        return $this->model->read();
    }

    public function addAnggota($nama, $telp) {
        $this->model->nama_anggota = $nama;
        $this->model->nomor_telepon = $telp;
        return $this->model->create();
    }

    public function getAnggotaById($id) {
        $this->model->id_anggota = $id;
        $this->model->getSingleAnggota();
        return $this->model;
    }

    public function updateAnggota($id, $nama, $telp) {
        $this->model->id_anggota = $id;
        $this->model->nama_anggota = $nama;
        $this->model->nomor_telepon = $telp;
        return $this->model->update();
    }

    public function deleteAnggota($id) {
        $this->model->id_anggota = $id;
        return $this->model->delete();
    }
}
?>