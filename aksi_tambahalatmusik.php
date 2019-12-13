<?php
include "koneksi.php";
$merk=$_POST['merk'];
$tipe=$_POST['tipe'];
$jenis=$_POST['jenis'];
$harga_sewa=$_POST['harga_sewa'];
$status=$_POST['status'];
$query=mysqli_query($connect,"insert into alatmusik(merk,tipe,jenis,harga_sewa,status)
values ('$merk','$tipe','$jenis','$harga_sewa','$status')");
if($query){
	header('location:alatmusik.php');
}else{
	echo mysqli_error($connect);
}
?>