<?php
require_once 'viewmodels/PenerbitViewModel.php';
$viewModel = new PenerbitViewModel();
$rows = $viewModel->viewList();
?>

<div class="mb-3 d-flex justify-content-between align-items-center">
    <h1>Daftar Penerbit</h1>
    <a href="index.php?page=penerbit_form" class="btn btn-primary">Tambah Penerbit</a>
</div>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nama Penerbit</th>
            <th>Kota</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?= $row['id_penerbit'] ?></td>
            <td><?= $row['nama_penerbit'] ?></td>
            <td><?= $row['kota_penerbit'] ?></td>
            <td>
                <a href="index.php?page=penerbit_form&id=<?= $row['id_penerbit'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="index.php?page=penerbit_delete&id=<?= $row['id_penerbit'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>