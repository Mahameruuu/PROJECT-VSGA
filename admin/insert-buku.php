<?php
session_start();
if (empty($_SESSION['username'])) {
    header('location:../index.php');
} else {
    include "../conn.php";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $nama = $_POST['nama'];
    $tahun = $_POST['tahun'];
    $penerbit = $_POST['penerbit'];
    $isbn = $_POST['isbn'];
    $kategori = $_POST['kategori'];
    $kode = $_POST['kode'];
    $jumlah = $_POST['jumlah'];
    $lokasi = $_POST['lokasi'];
    $asal = $_POST['asal'];
    $tempo = $_POST['tempo'];
    $tgl = $_POST['tgl'];

    $sql = "INSERT INTO data_buku(judul, pengarang, th_terbit, penerbit, isbn, kategori, kode_klas, jumlah_buku, lokasi, asal, jum_temp, tgl_input) VALUES 
    ('$judul', '$nama', '$tahun', '$penerbit', '$isbn', '$kategori', '$kode', '$jumlah', '$lokasi', '$asal', '$tempo', '$tgl')";
    if (mysqli_query($conn, $sql)) {
        header('Location: input-buku.php?status=success');
        exit;
    } else {
        header('Location: input-buku.php?status=error');
        exit;
    }
} else {
    header('Location: input-buku.php');
}
?>
