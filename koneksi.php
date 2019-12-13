<?php
$dbhost = "localhost";
$dbuser = "root";

$dbpass = '';
$dbname = "rental_alatmusik";
$connect = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
if ($connect->connect_error) {

	die ('maaf koneksi gagal:'.$connect->connect_error);
}
?>