<?php
session_start(); // Start session nya

include "koneksi.php"; // Load file koneksi.php

$username = mysqli_real_escape_string($connect, $_POST['username']); // Ambil value username yang dikirim dari form
$password = mysqli_real_escape_string($connect, $_POST['password']); // Ambil value password yang dikirim dari form
$password = md5($password); // Kita enkripsi (encrypt) password tadi dengan md5

// Buat query untuk mengecek apakah ada data admin dengan username dan password yang dikirim dari form
$sql = mysqli_query($connect, "SELECT * FROM admin WHERE username='".$username."' AND password='".$password."'");
$data = mysqli_fetch_array($sql); // Ambil datanya dari hasil query tadi

// Cek apakah variabel $data ada datanya atau tidak
if( ! empty($data)){ // Jika tidak sama dengan empty (kosong)
	$_SESSION['username'] = $data['username']; // Set session untuk username (simpan username di session)
	
	setcookie("message","delete",time()-1); // Kita delete cookie message
	
	header("location: index.php"); // Kita redirect ke halaman index.php
}else{ // Jika $data nya kosong
	// Buat sebuah cookie untuk menampung data pesan kesalahan
	setcookie("message", "Maaf, Username atau Password salah", time()+3600);
	
	header("location: login.php"); // Redirect kembali ke halaman login.php
}
?>