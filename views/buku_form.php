<?php
require_once 'viewmodels/BukuViewModel.php';
$viewModel = new BukuViewModel();
$id = $_GET['id'] ?? null;
$data = null;

// Ambil data untuk Dropdown
$kategoriList = $viewModel->getKategoriList();
$penerbitList = $viewModel->getPenerbitList();

if ($id) {
    $viewModel->getBukuById($id);
    $data = $viewModel->getBukuById($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang'];
    $id_kategori = $_POST['id_kategori'];
    $id_penerbit = $_POST['id_penerbit'];
    
    if ($id) {
        if ($viewModel->updateBuku($id, $judul, $pengarang, $id_kategori, $id_penerbit)) {
            header("Location: index.php?page=buku");
            exit;
        }
    } else {
        if ($viewModel->addBuku($judul, $pengarang, $id_kategori, $id_penerbit)) {
            header("Location: index.php?page=buku");
            exit;
        }
    }
}
?>

<div class="card">
    <div class="card-header bg-warning text-dark">
        <?= $id ? 'Edit' : 'Tambah' ?> Buku
    </div>
    <div class="card-body">
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Judul Buku</label>
                <input type="text" name="judul_buku" class="form-control" 
                       value="<?= $data ? $data->judul_buku : '' ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Pengarang</label>
                <input type="text" name="pengarang" class="form-control" 
                       value="<?= $data ? $data->pengarang : '' ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="id_kategori" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    <?php while ($kat = $kategoriList->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?= $kat['id_kategori'] ?>" 
                            <?= ($data && $data->id_kategori == $kat['id_kategori']) ? 'selected' : '' ?>>
                            <?= $kat['nama_kategori'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Penerbit</label>
                <select name="id_penerbit" class="form-select" required>
                    <option value="">Pilih Penerbit</option>
                    <?php while ($pen = $penerbitList->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?= $pen['id_penerbit'] ?>" 
                            <?= ($data && $data->id_penerbit == $pen['id_penerbit']) ? 'selected' : '' ?>>
                            <?= $pen['nama_penerbit'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php?page=buku" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>