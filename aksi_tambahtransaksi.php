<?php
include "koneksi.php";
$id_alatmusik=$_POST['id_alatmusik'];
$id_penyewa=$_POST['id_penyewa'];
$tgl_pinjam=$_POST['tgl_pinjam'];
$tgl_kembali=$_POST['tgl_kembali'];
if (isset($_GET['tgl_pinjam']) AND isset($_GET['tgl_kembali']))
{
   $nama=$_GET['tgl_pinjam'];
   $email=$_GET['tgl_kembali'];
}
else
{
   die("Maaf, anda harus mengakses halaman ini dari form.html");
}
  
if (!empty($nama))
{
   echo "Nama: $nama <br /> Email: $email";
}
else
{
   die("Maaf, anda harus mengisi nama");
}

$query=mysqli_query($connect,"insert into transaksi(id_alatmusik,id_penyewa,tgl_pinjam,tgl_kembali) values ('$id_alatmusik','$id_penyewa','$tgl_pinjam','$tgl_kembali')");
if($query){
    $status = mysqli_query($connect, "update alatmusik set status='Disewa' where id_alatmusik='$id_alatmusik' ");
    if ($status) {
        header('location:detailtransaksi.php');
    } else {
        echo mysqli_error($connect);
    }
}else{
	echo mysqli_error($connect);
}
?>