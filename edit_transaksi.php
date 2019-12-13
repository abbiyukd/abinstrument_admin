<?php
session_start(); // Start session nya

// Kita cek apakah user sudah login atau belum
// Cek nya dengan cara cek apakah terdapat session username atau tidak
if( ! isset($_SESSION['username'])){ // Jika tidak ada session username berarti dia belum login
  header("location: login.php"); // Kita Redirect ke halaman login.php karena belum login
}

include "koneksi.php";
$id_transaksi = $_GET['id_transaksi'];
$query = mysqli_query($connect, "select * from transaksi where id_transaksi='$id_transaksi'") or die(mysqli_error($connect));

while ($res = mysqli_fetch_array($query)) {
    $id_transaksi = $res['id_transaksi'];
    $id_alatmusik = $res['id_alatmusik'];
    $id_penyewa = $res['id_penyewa'];
    $tgl_pinjam = $res['tgl_pinjam'];
    $tgl_kembali = $res['tgl_kembali'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Edit Transaksi- AB Instrument</title>
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
                        <a class="nav-link href="alatmusik.php"><i class="fas fa-table"></i><span>Data Alatmusik</span></a>
                        <a class="nav-link" href="penyewa.php"><i class="fas fa-table"></i><span>Data Penyewa</span></a>
                        <a class="nav-link active"" href="transaksi.php"><i class="fas fa-table"></i><span>Data Transaksi</span></a>
                        <a class="nav-link" href="detailtransaksi.php"><i class="fas fa-table"></i><span>Detail Transaksi</span></a>
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
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
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
                <div class="col">
                        <div class="card shadow">
                            <div class="card-body">
                                <form method="post" action="aksi_edittransaksi.php?id_transaksi=<?php echo $id_transaksi; ?>">
                                    <div class="form-group">
                                        <label>
                                            <strong>Kode Transaksi</strong>
                                            <br>
                                        </label>
                                        <input disabled value="<?php echo $id_transaksi; ?>" class="form-control" type="text" name="id_transaksi" value="<?php echo $row['id_transaksi']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            <strong>Alat Musik</strong>
                                            <br>
                                        </label>
                                        <select class="form-control" name='id_alatmusik'>
                                        <?php 
                                            include "koneksi.php";
                                            $queryalatmusik = "SELECT * FROM alatmusik where id_alatmusik= $id_alatmusik";
                                            $resultalatmusik = mysqli_query($connect, $queryalatmusik) or die(mysqli_error($connect));
                                            $rowalatmusik = mysqli_fetch_array($resultalatmusik); 
                                        ?>
                                            <option selected value="<?php echo $rowalatmusik['id_alatmusik'];	?>" ><?php echo $rowalatmusik['jenis']; ?> - <?php echo $rowalatmusik['merk']; ?> <?php echo $rowalatmusik['tipe']; ?></option>
                                        <?php 
                                            include "koneksi.php";
                                            $query = "SELECT * FROM alatmusik where status='Masih' ";
                                            $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
                                            while($row = mysqli_fetch_array($result)) { 
                                        ?>
                                            <option value="<?php echo $row['id_alatmusik'];	?>" ><?php echo $row['jenis']; ?> - <?php echo $row['merk']; ?> <?php echo $row['tipe']; ?></option>
                                        <?php } ?>
                                        </select> 
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            <strong>Penyewa</strong>
                                            <br>
                                        </label>
                                        <select class="form-control" name='id_penyewa'>
                                        <?php 
                                            include "koneksi.php";
                                            $query = "SELECT * FROM penyewa";
                                            $querypenyewa = "SELECT id_penyewa FROM transaksi where id_transaksi= $id_transaksi";
                                            $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
                                            $resultpenyewa = mysqli_query($connect, $querypenyewa) or die(mysqli_error($connect));
                                            $rowpenyewa = mysqli_fetch_array($resultpenyewa);
                                            while($row = mysqli_fetch_array($result)) { 
                                        ?>
                                            <option value="<?php echo $row['id_penyewa'];	?>" <?php if ($row['id_penyewa'] == $rowpenyewa['id_penyewa']) echo 'selected = "selected"'; ?>><?php echo $row['nama']; ?> - <?php echo $row['id_penyewa']; ?></option>
                                        <?php } ?>
                                        </select> 
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            <strong>Tanggal Sewa</strong>
                                            <br>
                                        </label>
                                        <input value="<?php echo $tgl_pinjam; ?>" type="date" class="form-control" name="tgl_pinjam" value="<?php echo $row['tgl_pinjam']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            <strong>Tanggal Kembali</strong>
                                            <br>
                                        </label>
                                        <input value="<?php echo $tgl_kembali; ?>" type="date" class="form-control" name="tgl_kembali" value="<?php echo $row['tgl_kembali']; ?>" required>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                    </div>
                                </form>
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