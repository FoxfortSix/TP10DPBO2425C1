<?php
// Ambil parameter 'page' dari URL, default ke 'home' jika kosong
$page = $_GET['page'] ?? 'home';

// --- BAGIAN LOGIC (DELETE) ---
// Kita taruh logika delete di atas sebelum HTML dirender, 
// supaya fungsi header("Location: ...") berjalan tanpa error "Headers already sent".

if ($page === 'kategori_delete') {
    require_once 'viewmodels/KategoriViewModel.php';
    $vm = new KategoriViewModel();
    $vm->deleteKategori($_GET['id']);
    header("Location: index.php?page=kategori");
    exit;
}

if ($page === 'penerbit_delete') {
    require_once 'viewmodels/PenerbitViewModel.php';
    $vm = new PenerbitViewModel();
    $vm->deletePenerbit($_GET['id']);
    header("Location: index.php?page=penerbit");
    exit;
}

if ($page === 'anggota_delete') {
    require_once 'viewmodels/AnggotaViewModel.php';
    $vm = new AnggotaViewModel();
    $vm->deleteAnggota($_GET['id']);
    header("Location: index.php?page=anggota");
    exit;
}

if ($page === 'buku_delete') {
    require_once 'viewmodels/BukuViewModel.php';
    $vm = new BukuViewModel();
    $vm->deleteBuku($_GET['id']);
    header("Location: index.php?page=buku");
    exit;
}

if ($page === 'peminjaman_delete') {
    require_once 'viewmodels/PeminjamanViewModel.php';
    $vm = new PeminjamanViewModel();
    $vm->deletePeminjaman($_GET['id']);
    header("Location: index.php?page=peminjaman");
    exit;
}

// --- BAGIAN TAMPILAN (VIEW) ---

// 1. Tampilkan Header
include 'views/template/header.php';

// 2. Tampilkan Konten Sesuai Halaman
switch ($page) {
    case 'home':
        ?>
        <div class="p-5 mb-4 text-center bg-light rounded-3">
            <div class="py-5 container-fluid">
                <h1 class="display-5 fw-bold">Selamat Datang di Perpustakaan MVVM</h1>
                <p class="mx-auto col-md-8 fs-4">Sistem manajemen perpustakaan sederhana menggunakan arsitektur Model-View-ViewModel (MVVM) dan PHP Native.</p>
                <a class="btn btn-primary btn-lg" href="index.php?page=buku">Lihat Koleksi Buku</a>
            </div>
        </div>
        <?php
        break;

    // Kategori
    case 'kategori':      include 'views/kategori_list.php'; break;
    case 'kategori_form': include 'views/kategori_form.php'; break;

    // Penerbit
    case 'penerbit':      include 'views/penerbit_list.php'; break;
    case 'penerbit_form': include 'views/penerbit_form.php'; break;

    // Anggota
    case 'anggota':       include 'views/anggota_list.php'; break;
    case 'anggota_form':  include 'views/anggota_form.php'; break;

    // Buku
    case 'buku':          include 'views/buku_list.php'; break;
    case 'buku_form':     include 'views/buku_form.php'; break;

    // Peminjaman
    case 'peminjaman':      include 'views/peminjaman_list.php'; break;
    case 'peminjaman_form': include 'views/peminjaman_form.php'; break;

    default:
        echo "<div class='alert alert-danger'>Halaman tidak ditemukan!</div>";
        break;
}

// 3. Tampilkan Footer
include 'views/template/footer.php';
?>