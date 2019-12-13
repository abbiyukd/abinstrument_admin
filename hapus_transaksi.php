<?php
include "koneksi.php";
$id_transaksi=$_GET['id_transaksi'];
$transaksi = mysqli_query($connect, "SELECT * FROM transaksi where id_transaksi='$id_transaksi' ") or die(mysqli_error($connect));

while ($row = mysqli_fetch_array($transaksi)) {
    $id_transaksi = $row['id_transaksi'];
    $id_alatmusik = $row['id_alatmusik'];
}

$query=mysqli_query($connect,"delete from transaksi where id_transaksi='$id_transaksi'") or die (mysqli_error($connect));
if($query){
    $status = mysqli_query($connect, "update alatmusik set status='Masih' where id_alatmusik='$id_alatmusik'");
    if ($status) {
        header('location:detailtransaksi.php');
    } else {
        echo mysqli_error($connect);
    }
}else{
	echo mysqli_error($connect);
}
?>