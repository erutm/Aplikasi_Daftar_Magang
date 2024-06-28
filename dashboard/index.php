<?php

include '../auth.php';
include '../koneksi/koneksi.php';

$role = "";

$id     = $_SESSION['auth'];


if ($_SESSION['role_user'] == 0) {
    $role = "Admin";
    $query      = "SELECT * FROM akun WHERE id = $id";

    $exec       = mysqli_query($conn, $query);

    if ($exec) {

        while ($user = mysqli_fetch_array($exec)) {
            foreach ($user as $key => $val) {
                ${$key} = $val;
            }
        }
    }
} else {
    $role = "User";
    $query      = "SELECT a.*,b.*,c.* FROM pendaftaran a, akun b, detail_pendaftaran c WHERE a.id = $id AND b.id_user=$id AND c.id_user=$id";

    $exec       = mysqli_query($conn, $query);


    if ($exec) {
        while ($user = mysqli_fetch_array($exec)) {
            foreach ($user as $key => $val) {
                ${$key} = $val;
            }
        }
    }
}




$getPage = $_GET['page'];

switch ($getPage) {
    case 1:
        $page                 = "include/home.php";
        $_SESSION['active']    = "1";
        break;
    case 2:
        $page                 = "include/profile.php";
        $_SESSION['active']    = "2";
        break;
    case 3:
        $page                 = "include/edit_profile.php";
        $_SESSION['active']    = "2";
        break;
    case 4:
        $page                 = "include/syarat_pendaftaran.php";
        $_SESSION['active'] = "3";
        break;
    case 5:
        $page                 = "include/upload_surat.php";
        $_SESSION['active'] = "3";
        break;
    case 6:
        $page                 = "include/upload_foto.php";
        $_SESSION['active'] = "3";
        break;
    case 7:
        $page                 = "include/konfirmasi_pendaftaran.php";
        $_SESSION['active']    = "4";
        break;
    case 8:
        $page               = "include/detail_pendaftaran.php";
        $ida                = $_GET['ida'];
        $idd                = $_GET['idd'];
        $_SESSION['active'] = "4";
        break;
    case 9:
        $page               = "include/pembayaran.php";
        $_SESSION['active'] = "5";
        break;
    case 10:
        $page               = "include/guru.php";
        $_SESSION['active'] = 6;
        break;
    case 11:
        $page               = "include/tambah_dinas.php";
        $_SESSION['active'] = 6;
        break;
    case 12:
        $page               = "include/ubah_dinas.php";
        $_SESSION['active'] = 6;
        $id                 = $_GET['id'];
        break;
    case 13:
        $page               = "include/review_pembayaran_pendaftaran.php";
        $_SESSION['active'] = '5';
        break;
    case 14:
        $page               =  "include/konfirmasi_pembayaran_user.php";
        $_SESSION['active'] = '7';
        break;
    case 15:
        $page               =  "include/konfirmasi_pembayaran_pendaftaran.php";
        $_SESSION['active'] = '7';
        break;
    case 16:
        $page               = "include/konfirmasi_pembayaran_spp.php";
        $_SESSION['active'] = '7';
        break;
    case 17:
        $page               = "include/konfirmasi_pembayaran_pendaftaran_admin.php";
        $_SESSION['active'] = '8';
        break;
    case 18:
        $page               = "include/laporan.php";
        $_SESSION['active'] = "9";
        break;
    case 19:
        $page               = "include/mapel.php";
        $_SESSION['active'] = "10";
        break;
    case 20:
        $page               = "include/tambah_pembimbing.php";
        $_SESSION['active'] = "10";
        break;
    case 21:
        $page               = "include/ubah_pembimbing.php";
        $_SESSION['active'] = "10";
        $id                 = $_GET['id'];
        break;
    case 22:
        $page               = "include/jadwal.php";
        $_SESSION['active'] = "11";
        break;
    case 23:
        $page               = "include/tambah_jadwal.php";
        $_SESSION['active'] = "11";
        $kelas              = $_GET['kelas'];
        break;
    case 24:
        $page               = "include/jadwal_user.php";
        $_SESSION['active'] = "12";
        break;
    case 25:
        $page               = "include/pembimbing.php";
        $_SESSION['active'] = "13";
        break;
    case 26:
        $page               = "include/dinas.php";
        $_SESSION['active'] = "14";
        break;
    case 27:
        $page               = "include/konfirmasi_pembayaran_kegiatan.php";
        $_SESSION['active'] = "7";
        break;
    case 28:
        $page               = "include/detail_pendaftaran.php";
        $ida                = $_GET['ida'];
        $idd                = $_GET['idd'];
        $_SESSION['active'] = "4";
        break;
    default:
        $page     = "include/home.php";
        $_SESSION['active']    = "1";
        break;
}

?>

<!doctype html>
<html lang="en">

<head>

    <title>Dashboard <?php echo $role; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <?php
    include "include/libs.php";
    ?>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="blue" data-image="../assets/img/sidebar-1.jpg">
            <!--
                Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

                Tip 2: you can also add an image using data-image tag
            -->
            <div class="logo">
                <a href="index.php?page=1" class="simple-text">
                    <div class="profile-info">
                        <h3><?php $role == "Admin" ? print($nama_admin) : print($nama_panggilan); ?></h3>
                        <h7><?php echo $role; ?></h7>
                    </div>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="<?php $_SESSION['active'] == 1 ? print("active") : print("") ?>">
                        <a href="index.php?page=1">
                            <i class="material-icons">dashboard</i>
                            <p>Home</p>
                        </a>
                    </li>

                    <?php
                    if ($role == "User") {
                    ?>
                        <li class="<?php $_SESSION['active'] == 2 ? print("active") : print("") ?>">
                            <a href="index.php?page=2">
                                <i class="material-icons">person</i>
                                <p>User Profile </p>
                            </a>
                        </li>
                    <?php
                    }
                    ?>


                    <?php
                    if ($role == "Admin") {
                    ?>
                        <li class="<?php $_SESSION['active'] == 4 ? print("active") : print("") ?>">
                            <a href="index.php?page=7">
                                <i class="material-icons">content_paste</i>
                                <p>Konfirmasi Pendaftaran </p>
                            </a>
                        </li>
                        <!-- <li class="<?php $_SESSION['active'] == 6 ? print("active") : print("") ?>">
                            <a href="index.php?page=10">
                                <i class="material-icons">supervisor_account</i>
                                <p>Guru</p>
                            </a>
                        </li> -->
                        <!-- <li class="<?php $_SESSION['active'] == 8 ? print("active") : print("") ?>">
                            <a href="index.php?page=17">
                                <i class="material-icons">supervisor_account</i>
                                <p>Konfirmasi Pembayaran Pendaftaran</p>
                            </a>
                        </li> -->
                        <li class="<?php $_SESSION['active'] == 13 ? print("active") : print("") ?>">
                            <a href="index.php?page=25">
                                <i class="material-icons">supervisor_account</i>
                                <p>Pembimbing</p>
                            </a>
                        </li>
                        <li class="<?php $_SESSION['active'] == 14 ? print("active") : print("") ?>">
                            <a href="index.php?page=26">
                                <i class="material-icons">home</i>
                                <p>Dinas - Bidang</p>
                            </a>
                        </li>
                        <li class="<?php $_SESSION['active'] == 9 ? print("active") : print("") ?>">
                            <a href="index.php?page=18">
                                <i class="material-icons">subject</i>
                                <p>Laporan</p>
                            </a>
                        </li>
                        <!-- <li class="<?php $_SESSION['active'] == 10 ? print("active") : print("") ?>">
                            <a href="index.php?page=19">
                                <i class="material-icons">subject</i>
                                <p>Mata Pelajaran</p>
                            </a>
                        </li> -->
                    <?php
                    }
                    ?>

                    <?php
                    if ($role == "User") {
                    ?>
                        <li class="<?php $_SESSION['active'] == 3 ? print("active") : print("") ?>">
                            <a href="index.php?page=4">
                                <i class="material-icons">content_paste</i>
                                <p>Syarat Pendaftaran</p>
                            </a>
                        </li>
                        <!-- <li class="<?php $_SESSION['active'] == 5 ? print("active") : print("") ?>">
                            <a href="index.php?page=9">
                                <i class="material-icons">library_books</i>
                                <p>Pembayaran</p>
                            </a>
                        </li>
                        <li class="<?php $_SESSION['active'] == 7 ? print("active") : print("") ?>">
                            <a href="index.php?page=14">
                                <i class="material-icons">library_books</i>
                                <p>Konfirmasi Pembayaran</p>
                            </a>
                        </li> -->
                        <!-- <li class="<?php $_SESSION['active'] == 12 ? print("active") : print("") ?>">
                            <a href="index.php?page=24">
                                <i class="material-icons">library_books</i>
                                <p>Jadwal</p>
                            </a>
                        </li> -->


                    <?php
                    }
                    ?>




                    <li>
                        <a href="../logout.php">
                            <i class="material-icons text-gray">exit_to_app</i>
                            <p>Logout</p>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">

                    <?php

                    include $page;

                    ?>

                </div>
            </div>
            <!-- <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                    </p>
                </div>
            </footer> -->
        </div>
    </div>
</body>

<!--   Core JS Files   -->
<script src="../assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/js/material.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="../assets/js/chartist.min.js"></script>
<!--  Dynamic Elements plugin -->
<script src="../assets/js/arrive.min.js"></script>
<!--  PerfectScrollbar Library -->
<script src="../assets/js/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
<!-- Material Dashboard javascript methods -->
<script src="../assets/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/js/demo.js"></script>

<script>
    $(document).ready(function() {
        $("#cetak").click(function() {
            window.print();
        });
    });
</script>

<?php if ($rows['status'] == 'ditolak'): ?>
    <a href='#rejectModal<?php echo $rows['id_daftar'] ?>' data-toggle='modal' class='btn btn-danger btn-sm'>Ditolak</a>
<?php endif; ?>

<!-- Modal for rejection reason -->
<div class="modal fade" id="rejectModal<?php echo $rows['id_daftar'] ?>" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tolak Pendaftaran</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" action="./include/proses_tolak_pendaftaran.php">
                    <div class="form-group">
                        <label for="reason">Alasan Penolakan:</label>
                        <textarea name="reason" class="form-control" id="reason" required></textarea>
                    </div>
                    <input type="hidden" name="idd" value="<?php echo $rows['id_daftar'] ?>">
                    <input type="hidden" name="idu" value="<?php echo $Id ?>">
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</html>