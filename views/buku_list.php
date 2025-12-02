<?php
require_once 'viewmodels/BukuViewModel.php';
$viewModel = new BukuViewModel();
$rows = $viewModel->viewList();
?>

<div class="mb-3 d-flex justify-content-between align-items-center">
    <h1>Daftar Buku</h1>
    <a href="index.php?page=buku_form" class="btn btn-primary">Tambah Buku</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Judul Buku</th>
            <th>Pengarang</th>
            <th>Kategori</th>
            <th>Penerbit</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?= $row['id_buku'] ?></td>
            <td><?= $row['judul_buku'] ?></td>
            <td><?= $row['pengarang'] ?></td>
            <td><?= $row['nama_kategori'] ?></td> <td><?= $row['nama_penerbit'] ?></td> <td>
                <a href="index.php?page=buku_form&id=<?= $row['id_buku'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="index.php?page=buku_delete&id=<?= $row['id_buku'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>