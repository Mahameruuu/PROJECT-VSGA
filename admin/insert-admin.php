<?php
$namafolder = "gambar_admin/"; //tempat menyimpan file

include "../conn.php";

if (!empty($_FILES["nama_file"]["tmp_name"])) {
    $jenis_gambar = $_FILES['nama_file']['type'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];

    if ($jenis_gambar == "image/jpeg" || $jenis_gambar == "image/jpg" || $jenis_gambar == "image/x-png") {
        $gambar = $namafolder . basename($_FILES['nama_file']['name']);
        if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar)) {
            // Validate and handle user_id
            if (!empty($_POST['user_id']) && is_numeric($_POST['user_id'])) {
                $user_id = $_POST['user_id'];
                // If user_id is provided, include it in the query
                $sql = "INSERT INTO admin(user_id, username, password, fullname, gambar) VALUES 
                        ('$user_id', '$username', '$password', '$fullname', '$gambar')";
            } else {
                // If user_id is not provided or not valid, exclude it from the query
                $sql = "INSERT INTO admin(username, password, fullname, gambar) VALUES 
                        ('$username', '$password', '$fullname', '$gambar')";
            }

            $insert = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            echo "Gambar berhasil dikirim ke direktori " . $gambar;
            echo "<h3><a href='input-admin.php'> Input Lagi</a></h3>";
            echo "<h3><a href='admin.php'> Data Admin</a></h3>";
        } else {
            echo "<p>Gambar gagal dikirim</p>";
        }
    } else {
        echo "Jenis gambar yang anda kirim salah. Harus .jpg .gif .png";
    }
} else {
    echo "Anda belum memilih gambar";
}

?>