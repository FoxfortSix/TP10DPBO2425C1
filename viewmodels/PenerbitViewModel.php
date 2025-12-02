<?php
require_once 'config/Database.php';
require_once 'models/Penerbit.php';

class PenerbitViewModel {
    private $model;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new Penerbit($db);
    }

    public function viewList() {
        return $this->model->read();
    }

    public function addPenerbit($nama, $kota) {
        $this->model->nama_penerbit = $nama;
        $this->model->kota_penerbit = $kota;
        return $this->model->create();
    }

    public function getPenerbitById($id) {
        $this->model->id_penerbit = $id;
        $this->model->getSinglePenerbit();
        return $this->model;
    }

    public function updatePenerbit($id, $nama, $kota) {
        $this->model->id_penerbit = $id;
        $this->model->nama_penerbit = $nama;
        $this->model->kota_penerbit = $kota;
        return $this->model->update();
    }

    public function deletePenerbit($id) {
        $this->model->id_penerbit = $id;
        return $this->model->delete();
    }
}
?>