<?php
include "koneksi.php";
$id_penyewa=$_POST['id_penyewa'];
$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$no_hp=$_POST['no_hp'];
$query=mysqli_query($connect,"insert into penyewa(id_penyewa,nama,alamat,no_hp) values ('$id_penyewa','$nama','$alamat','$no_hp')");
if($query){
	header('location:penyewa.php');
}else{
	echo mysqli_error($connect);
}
?>