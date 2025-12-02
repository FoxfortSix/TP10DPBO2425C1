<?php
require_once 'viewmodels/AnggotaViewModel.php';
$viewModel = new AnggotaViewModel();
$rows = $viewModel->viewList();
?>

<div class="mb-3 d-flex justify-content-between align-items-center">
    <h1>Daftar Anggota</h1>
    <a href="index.php?page=anggota_form" class="btn btn-primary">Tambah Anggota</a>
</div>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nama Anggota</th>
            <th>No. Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?= $row['id_anggota'] ?></td>
            <td><?= $row['nama_anggota'] ?></td>
            <td><?= $row['nomor_telepon'] ?></td>
            <td>
                <a href="index.php?page=anggota_form&id=<?= $row['id_anggota'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="index.php?page=anggota_delete&id=<?= $row['id_anggota'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>