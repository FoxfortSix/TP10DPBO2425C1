<?php
require_once 'viewmodels/AnggotaViewModel.php';
$viewModel = new AnggotaViewModel();
$id = $_GET['id'] ?? null;
$data = null;

if ($id) {
    $viewModel->getAnggotaById($id);
    $data = $viewModel->getAnggotaById($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_anggota'];
    $telp = $_POST['nomor_telepon'];
    
    if ($id) {
        if ($viewModel->updateAnggota($id, $nama, $telp)) {
            header("Location: index.php?page=anggota");
            exit;
        }
    } else {
        if ($viewModel->addAnggota($nama, $telp)) {
            header("Location: index.php?page=anggota");
            exit;
        }
    }
}
?>

<div class="card">
    <div class="text-white card-header bg-info">
        <?= $id ? 'Edit' : 'Tambah' ?> Anggota
    </div>
    <div class="card-body">
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Anggota</label>
                <input type="text" name="nama_anggota" class="form-control" 
                       value="<?= $data ? $data->nama_anggota : '' ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" name="nomor_telepon" class="form-control" 
                       value="<?= $data ? $data->nomor_telepon : '' ?>">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php?page=anggota" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>