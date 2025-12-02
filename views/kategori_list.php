<?php
// Inisialisasi ViewModel
require_once 'viewmodels/KategoriViewModel.php';
$viewModel = new KategoriViewModel();
$rows = $viewModel->viewList();
?>

<div class="mb-3 d-flex justify-content-between align-items-center">
    <h1>Daftar Kategori</h1>
    <a href="index.php?page=kategori_form" class="btn btn-primary">Tambah Kategori</a>
</div>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?= $row['id_kategori'] ?></td>
            <td><?= $row['nama_kategori'] ?></td>
            <td>
                <a href="index.php?page=kategori_form&id=<?= $row['id_kategori'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="index.php?page=kategori_delete&id=<?= $row['id_kategori'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>