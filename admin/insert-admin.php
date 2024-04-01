<?php
$namafolder = "gambar_admin/"; // tempat menyimpan file

include "../conn.php";

if (!empty($_FILES["nama_file"]["tmp_name"])) {
    $namaFile = $_FILES['nama_file']['name'];
    $ukuranFile = $_FILES['nama_file']['size'];
    $error = $_FILES['nama_file']['error'];
    $tmpName = $_FILES['nama_file']['tmp_name'];

    $ekstensiValid = ['jpg', 'jpeg', 'png', 'gif']; // ekstensi file yang diperbolehkan
    $ekstensiFile = explode('.', $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    if (in_array($ekstensiFile, $ekstensiValid)) {
        if ($error === 0) {
            $gambar = $namafolder . uniqid() . '.' . $ekstensiFile; // generate nama unik
            if (move_uploaded_file($tmpName, $gambar)) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $fullname = $_POST['fullname'];
                $user_id = $_POST['user_id'] ?? null; // gunakan null jika tidak ada

                $stmt = $conn->prepare("INSERT INTO admin(user_id, username, password, fullname, gambar) VALUES (?, ?, ?, ?, ?)");

                if ($stmt) {
                    $stmt->bind_param("issss", $user_id, $username, $password, $fullname, $gambar);
                    $stmt->execute();
                    echo "Gambar berhasil dikirim ke direktori " . $gambar;
                    echo "<h3><a href='input-admin.php'> Input Lagi</a></h3>";
                    echo "<h3><a href='admin.php'> Data Admin</a></h3>";
                } else {
                    echo "Error dalam membuat statement";
                }
            } else {
                echo "<p>Gambar gagal dikirim</p>";
            }
        } else {
            echo "Upload gambar gagal, terdapat error pada file yang diupload";
        }
    } else {
        echo "Jenis gambar yang anda kirim salah. Harus .jpg .gif .png";
    }
} else {
    echo "Anda belum memilih gambar";
}
?>