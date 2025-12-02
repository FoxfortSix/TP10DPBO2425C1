<?php
require_once 'viewmodels/PenerbitViewModel.php';
$viewModel = new PenerbitViewModel();
$id = $_GET['id'] ?? null;
$data = null;

if ($id) {
    $viewModel->getPenerbitById($id);
    $data = $viewModel->getPenerbitById($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_penerbit'];
    $kota = $_POST['kota_penerbit'];
    
    if ($id) {
        if ($viewModel->updatePenerbit($id, $nama, $kota)) {
            header("Location: index.php?page=penerbit");
            exit;
        }
    } else {
        if ($viewModel->addPenerbit($nama, $kota)) {
            header("Location: index.php?page=penerbit");
            exit;
        }
    }
}
?>

<div class="card">
    <div class="text-white card-header bg-success">
        <?= $id ? 'Edit' : 'Tambah' ?> Penerbit
    </div>
    <div class="card-body">
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Penerbit</label>
                <input type="text" name="nama_penerbit" class="form-control" 
                       value="<?= $data ? $data->nama_penerbit : '' ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kota</label>
                <input type="text" name="kota_penerbit" class="form-control" 
                       value="<?= $data ? $data->kota_penerbit : '' ?>">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php?page=penerbit" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>