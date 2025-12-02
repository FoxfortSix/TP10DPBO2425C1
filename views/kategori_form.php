<?php
require_once 'viewmodels/KategoriViewModel.php';
$viewModel = new KategoriViewModel();
$id = $_GET['id'] ?? null;
$data = null;

// Jika ada ID, berarti mode EDIT -> Ambil data lama
if ($id) {
    $viewModel->getKategoriById($id);
    $data = $viewModel->getKategoriById($id);
}

// Handle saat tombol Submit ditekan (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_kategori'];
    
    if ($id) {
        // Mode Update
        if ($viewModel->updateKategori($id, $nama)) {
            header("Location: index.php?page=kategori");
            exit;
        }
    } else {
        // Mode Create
        if ($viewModel->addKategori($nama)) {
            header("Location: index.php?page=kategori");
            exit;
        }
    }
}
?>

<div class="card">
    <div class="text-white card-header bg-primary">
        <?= $id ? 'Edit' : 'Tambah' ?> Kategori
    </div>
    <div class="card-body">
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" 
                       value="<?= $data ? $data->nama_kategori : '' ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php?page=kategori" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>