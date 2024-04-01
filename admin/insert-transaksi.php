<?php
session_start();
if (empty($_SESSION['username'])) {
    header('location:../index.php');
} else {
    include "../conn.php";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul_buku'];
    $nama = $_POST['nama_peminjam'];
    $pinjam = $_POST['tgl_pinjam'];
    $kembali = $_POST['tgl_kembali'];
    $status = $_POST['status'];
    $keterangan = $_POST['ket'];
    
    $sql = "INSERT INTO trans_pinjam(judul_buku, nama_peminjam, tgl_pinjam, tgl_kembali, status, ket) VALUES 
    ('$judul', '$nama', '$pinjam', '$kembali', 'Dipinjam', '$keterangan')";
    if (mysqli_query($conn, $sql)) {
        header('Location: input-transaksi.php?status=success');
        exit;
    } else {
        header('Location: input-transaksi.php?status=error');
        exit;
    }
} else {
    header('Location: input-transaksi.php');
}
?>
