<?php
include "koneksi.php";
$id_penyewa = $_GET['id_penyewa'];
$query=mysqli_query($connect,"delete from penyewa where id_penyewa='$id_penyewa'") or die (mysqli_error($connect));
if($query){
	header('location:penyewa.php');
}else{
	echo mysqli_error($connect);
}
?>