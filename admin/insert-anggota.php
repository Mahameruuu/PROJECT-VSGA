<?php
$namafolder="gambar_anggota/"; //tempat menyimpan file

include "../conn.php";

if (!empty($_FILES["nama_file"]["tmp_name"]))
{
	$jenis_gambar=$_FILES['nama_file']['type'];
	$no_induk = $_POST['no_induk'];
	$nama= $_POST['nama'];
	$jk=$_POST['jk'];
	$kelas = $_POST['kelas'];
	$ttl = $_POST['ttl'];
	$alamat=$_POST['alamat'];
		
	if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png")
	{			
		$gambar = $namafolder . basename($_FILES['nama_file']['name']);		
		if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar)) {
			if (!empty($_POST['id']) && is_numeric($_POST['id'])) {
                $id = $_POST['id'];
                $sql="INSERT INTO data_anggota(id,no_induk,nama,jk,kelas,ttl,alamat,foto) VALUES
				('$id','$no_induk','$nama','$jk','$kelas','$ttl','$alamat','$gambar')";
            } else {
                $sql="INSERT INTO data_anggota(no_induk,nama,jk,kelas,ttl,alamat,foto) VALUES
            	('$no_induk','$nama','$jk','$kelas','$ttl','$alamat','$gambar')";
            }
			
			$req = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			echo "Gambar berhasil dikirim ke direktori".$gambar;
            echo "<h3><a href='input-anggota.php'> Input Lagi</a></h3>";
            echo "<h3><a href='anggota.php'> Data Anggota</a></h3>";	   
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