<?php
include "koneksi.php";
$id_alatmusik = $_GET['id_alatmusik'];
$query=mysqli_query($connect,"delete from alatmusik where id_alatmusik='$id_alatmusik'") or die (mysqli_error($connect));
if($query){
	header('location:alatmusik.php');
}else{
	echo mysqli_error($connect);
}
?>