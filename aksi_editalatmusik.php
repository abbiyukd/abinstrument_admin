<?php
include "koneksi.php";
$id_alatmusik=$_GET['id_alatmusik'];
$merk=$_POST['merk'];
$tipe=$_POST['tipe'];
$jenis=$_POST['jenis'];
$harga_sewa=$_POST['harga_sewa'];
$status=$_POST['status'];
$query=mysqli_query($connect,"update alatmusik set id_alatmusik='$id_alatmusik',merk='$merk',tipe='$tipe',jenis='$jenis',harga_sewa='$harga_sewa',status='$status'where id_alatmusik='$id_alatmusik'")
or die(mysqli_error($connect));
if($query){
	header('location:alatmusik.php');
}else{
	echo mysqli_error($connect);
}
?>