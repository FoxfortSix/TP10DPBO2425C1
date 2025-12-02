<?php
require_once 'viewmodels/PeminjamanViewModel.php';
$viewModel = new PeminjamanViewModel();
$rows = $viewModel->viewList();
?>

<div class="mb-3 d-flex justify-content-between align-items-center">
    <h1>Daftar Peminjaman</h1>
    <a href="index.php?page=peminjaman_form" class="btn btn-primary">Catat Peminjaman</a>
</div>

<table class="table border table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tanggal Pinjam</th>
            <th>Judul Buku</th>
            <th>Peminjam</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?= $row['id_peminjaman'] ?></td>
            <td><?= $row['tanggal_pinjam'] ?></td>
            <td><?= $row['judul_buku'] ?></td>
            <td><?= $row['nama_anggota'] ?></td>
            <td>
                <a href="index.php?page=peminjaman_form&id=<?= $row['id_peminjaman'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="index.php?page=peminjaman_delete&id=<?= $row['id_peminjaman'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>