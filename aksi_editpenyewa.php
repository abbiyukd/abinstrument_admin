<?php
include "koneksi.php";
$id_penyewa = $_GET['id_penyewa'];
$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$no_hp=$_POST['no_hp'];
$query=mysqli_query($connect,"update penyewa set id_penyewa='$id_penyewa', nama='$nama', alamat='$alamat', no_hp='$no_hp' where id_penyewa='$id_penyewa'") or die (mysqli_error($connect));
if($query){
	header('location:penyewa.php');
}else{
	echo mysqli_error($connect);
}
?>