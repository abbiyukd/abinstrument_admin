<?php
include "koneksi.php";
$id_transaksi=$_GET['id_transaksi'];
$id_alatmusik=$_POST['id_alatmusik'];
$id_penyewa=$_POST['id_penyewa'];
$tgl_pinjam=$_POST['tgl_pinjam'];
$tgl_kembali=$_POST['tgl_kembali'];

$transaksi = mysqli_query($connect, "SELECT * FROM transaksi where id_transaksi='$id_transaksi' ") or die(mysqli_error($connect));

while ($row = mysqli_fetch_array($transaksi)) {
    $id_transaksi = $row['id_transaksi'];
    $id_alatmusik2 = $row['id_alatmusik'];
}

$alatmusik=mysqli_query($connect,"update alatmusik set status='Masih' where id_alatmusik='$id_alatmusik2'") or die (mysqli_error($connect));

$query=mysqli_query($connect,"update transaksi set id_transaksi='$id_transaksi',id_alatmusik='$id_alatmusik',id_penyewa='$id_penyewa',tgl_pinjam='$tgl_pinjam',tgl_kembali='$tgl_kembali' where id_transaksi='$id_transaksi'")
or die(mysqli_error($connect));
if($query){
    $status = mysqli_query($connect, "update alatmusik set status='Disewa' where id_alatmusik='$id_alatmusik'");
    if ($status) {
        header('location:detailtransaksi.php');
    } else {
        echo mysqli_error($connect);
    }
}else{
	echo mysqli_error($connect);
}
?>