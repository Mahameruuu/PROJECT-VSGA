<?php
include ("conn.php");
date_default_timezone_set('Asia/Jakarta');

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

if (empty($username) && empty($password)) {
	header('location:login.html?error1');
	exit;
} else if (empty($username)) {
	header('location:login.html?error=2');
	exit;
} else if (empty($password)) {
	header('location:login.html?error=3');
	exit;
}

$q = "select * from admin where username='$username' and password='$password'";
$row = mysqli_query($conn, $q);

if(!$row){
	die("Query Gagal : " . mysqli_error($conn));
}

if (mysqli_num_rows($row) == 1) {
    $row = mysqli_fetch_array($row);
	$_SESSION['user_id'] = $row['user_id'];
	$_SESSION['username'] = $username;
	$_SESSION['fullname'] = $row['fullname'];
    $_SESSION['gambar'] = $row['gambar'];	

	header('location:admin/index.php');
} else {
	header('location:login.html?error=4');
}

mysqli_close($conn);
?>