<?php
require_once 'viewmodels/PeminjamanViewModel.php';
$viewModel = new PeminjamanViewModel();
$id = $_GET['id'] ?? null;
$data = null;

// Ambil data Dropdown
$bukuList = $viewModel->getBukuList();
$anggotaList = $viewModel->getAnggotaList();

if ($id) {
    $viewModel->getPeminjamanById($id);
    $data = $viewModel->getPeminjamanById($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_buku = $_POST['id_buku'];
    $id_anggota = $_POST['id_anggota'];
    $tanggal = $_POST['tanggal_pinjam'];
    
    if ($id) {
        if ($viewModel->updatePeminjaman($id, $id_buku, $id_anggota, $tanggal)) {
            header("Location: index.php?page=peminjaman");
            exit;
        }
    } else {
        if ($viewModel->addPeminjaman($id_buku, $id_anggota, $tanggal)) {
            header("Location: index.php?page=peminjaman");
            exit;
        }
    }
}
?>

<div class="card">
    <div class="text-white card-header bg-danger">
        <?= $id ? 'Edit' : 'Tambah' ?> Peminjaman
    </div>
    <div class="card-body">
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" class="form-control" 
                       value="<?= $data ? $data->tanggal_pinjam : date('Y-m-d') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Buku yang Dipinjam</label>
                <select name="id_buku" class="form-select" required>
                    <option value="">Pilih Buku</option>
                    <?php while ($buku = $bukuList->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?= $buku['id_buku'] ?>" 
                            <?= ($data && $data->id_buku == $buku['id_buku']) ? 'selected' : '' ?>>
                            <?= $buku['judul_buku'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Anggota Peminjam</label>
                <select name="id_anggota" class="form-select" required>
                    <option value="">Pilih Anggota</option>
                    <?php while ($agt = $anggotaList->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?= $agt['id_anggota'] ?>" 
                            <?= ($data && $data->id_anggota == $agt['id_anggota']) ? 'selected' : '' ?>>
                            <?= $agt['nama_anggota'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php?page=peminjaman" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>