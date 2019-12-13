<?php
session_start(); // Start session nya

// Kita cek apakah user sudah login atau belum
// Cek nya dengan cara cek apakah terdapat session username atau tidak
if( ! isset($_SESSION['username'])){ // Jika tidak ada session username berarti dia belum login
  header("location: login.php"); // Kita Redirect ke halaman login.php karena belum login
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Detail Transaksi - AB Instrument</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-music"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>AB Instrument</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="index.php"><i class="fas fa-window-maximize"></i><span>Home</span></a>
                        <a class="nav-link" href="alatmusik.php"><i class="fas fa-table"></i><span>Data Alatmusik</span></a>
                        <a class="nav-link" href="penyewa.php"><i class="fas fa-table"></i><span>Data Penyewa</span></a>
                        <a class="nav-link" href="transaksi.php"><i class="fas fa-table"></i><span>Data Transaksi</span></a>
                        <a class="nav-link active" href="detailtransaksi.php"><i class="fas fa-table"></i><span>Detail Transaksi</span></a>
                    </li>
                    <li class="nav-item" role="presentation"></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Views</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="view_alatmusik.php">Alat Musik</a>
                                <a class="dropdown-item" href="view_penyewa.php">Penyewa</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="about.php" tabindex="-1" aria-disabled="true">About</a>
                        </li>
                    </ul>
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <form class="form-inline mr-auto navbar-search w-100" action="detailtransaksi.php" method="get">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" name="search" placeholder="Cari transaksi ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                            </form>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow" role="presentation">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
                                    <span class="d-none d-lg-inline mr-2 text-gray-600 small">
                                    <?php
                                        include "koneksi.php";
                                        $username = $_SESSION['username'];
                                        $query = "SELECT * from admin where username='$username'";
                                        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
                                        while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <?php echo $row['nama']; ?>
                                    <?php
                                        }
                                    ?>
                                    </span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg"></a>
                                        <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
                                            <a class="dropdown-item" role="presentation" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a></div>
                    </div>
                    </li>
                    </ul>
            </div>
            </nav>
            <div class="container-fluid">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Detail Transaksi</p>
                        </div>
                        <div class="card-body">
                            <a class="card-link" href="tambah_transaksi.php"><button class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Tambah Transaksi</button></a>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Kode Transaksi</th>    
                                            <th>Nama Penyewa</th>
                                            <th>Nomor HP</th>
                                            <th>Jenis</th>
                                            <th>Merk</th>
                                            <th>Tipe</th>
                                            <th>Tanggal Sewa</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Total Harga</th>
                                            <th>Pilihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        function rupiah($angka){
                                            $hasil_rupiah = "Rp. " . number_format($angka,2,',','.');
                                            return $hasil_rupiah;
                                        }
                                        include "koneksi.php";
                                        if(isset($_GET['search'])){
                                            $search = $_GET['search'];
                                            $query = "select * from detailtransaksi where nama like '%".$search."%' or no_hp like '%".$search."%' or jenis like '%".$search."%' or merk like '%".$search."%' or tipe like '%".$search."%' or total_harga like '%".$search."%'";
                                            $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
                                        }
                                        else {
                                            $query = "select * from detailtransaksi";
                                            $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
                                        } 
                                        while ($row = mysqli_fetch_array($result)) {
                                            $total_harga = $row['total_harga'];
                                        ?>
                                            <tr>
                                                <td><?php echo $row['id_transaksi']; ?></td>
                                                <td><?php echo $row['nama']; ?></td>
                                                <td><?php echo $row['no_hp']; ?></td>
                                                <td><?php echo $row['jenis']; ?></td>
                                                <td><?php echo $row['merk']; ?></td>
                                                <td><?php echo $row['tipe']; ?></td>
                                                <td><?php echo $row['tgl_pinjam']; ?></td>
                                                <td><?php echo $row['tgl_kembali']; ?></td>
                                                <td><?php echo rupiah($total_harga) ?></td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href='edit_transaksi.php?id_transaksi=<?php echo $row['id_transaksi']; ?>'>
                                                            <button class="btn btn-primary btn-success" type="button">
                                                                <i class="fa fa-edit"></i>Edit</button>
                                                        </a>
                                                        <a href='hapus_transaksi.php?id_transaksi=<?php echo $row['id_transaksi']; ?>'>
                                                            <button class="btn btn-primary btn-danger" type="button">
                                                                <i class="fa fa-trash"></i>Delete</button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © Abbiyu Kirana Distira 2019</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>