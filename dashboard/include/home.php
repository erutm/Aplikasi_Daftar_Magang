<?php
if ($role == 'Admin') {
    $queryAccepted = $conn->query("SELECT * FROM pendaftaran JOIN detail_pendaftaran ON detail_pendaftaran.id_user = pendaftaran.Id WHERE status_pendaftaran = 1");
    $acceptedCount = mysqli_num_rows($queryAccepted);
    
    $queryRejected = $conn->query("SELECT * FROM pendaftaran JOIN detail_pendaftaran ON detail_pendaftaran.id_user = pendaftaran.Id WHERE status_pendaftaran = 2");
    $rejectedCount = mysqli_num_rows($queryRejected);
?>
<h3><b>Selamat Datang, <?php echo $role == "Admin" ?  strtoupper($nama_admin) : ($nama); ?></b></h3>
    <!-- <div class="container"> -->
    <div class="row text-center">
        <div class="col-lg-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="gb">
                    <i class="material-icons">info_outline</i>
                </div>
                <div class="card-content">
                    <p class="category"><b>Pendaftaran Belum Dikonfirmasi</b></p>
                    <h3 class="title"><?php
                                        $query1      = $conn->query("SELECT * FROM pendaftaran JOIN detail_pendaftaran ON detail_pendaftaran.id_user = pendaftaran.Id WHERE status_pendaftaran = 0");
                                        $blm_konfirm = mysqli_num_rows($query1);
                                        echo number_format($blm_konfirm);
                                        ?>
                    </h3>
                    <div class="card-footer">
                    <div class="stats" style="text-align: right;">
                        <i class="fa fa-info-circle"></i> <a href="index.php?page=7">More Info</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-lg-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="gb">
                    <i class="fa fa-group"></i>
                </div>
                <div class="card-content">
                    <p class="category"><b>Pendaftar Masuk</b></p>
                    <h3 class="title"><?php
                                        $query2      = $conn->query("SELECT * FROM pendaftaran JOIN detail_pendaftaran ON detail_pendaftaran.id_user = pendaftaran.Id");
                                        $total_pendaftar = mysqli_num_rows($query2);
                                        echo number_format($total_pendaftar);
                                        ?>
                    </h3>
                    <div class="card-footer">
                    <div class="stats" style="text-align: right;">
                        <i class="fa fa-info-circle"></i> <a href="index.php?page=7">More Info</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->

<?php
} else {
?>
<h3><b>Selamat Datang, <?php echo $role == "User" ?  strtoupper($nama) : ($nama); ?></b></h3>
    <div class="row text-center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <h4>Status Pendaftaran <?php print strtoupper($nama_panggilan) ?></h4>
                </div>
                <div class="card-content">
                    <?php
                    $sql = $conn->query("SELECT * FROM pembimbing where Id = $id_pembimbing");
                    $data = $sql->fetch_assoc();
                    $sql_pendaftaran = $conn->query("SELECT status_pendaftaran, reason_rejection FROM detail_pendaftaran WHERE id_user = $id");
                    $pendaftaran = $sql_pendaftaran->fetch_assoc();
                    ?>
                    <!-- <p class="category">Revenue</p> -->
                    <?php if ($pendaftaran['status_pendaftaran'] == 0) {
                        echo '<h3><b>Menunggu</b></h3>';
                    } elseif ($pendaftaran['status_pendaftaran'] == 1) {
                        echo '<h3><b>Diterima Magang</b></h3>';
                        echo '<h5>Pembimbing Anda adalah ' . $data['nama_pembimbing'] . '</h5>';
                    } else {
                        echo '<h3><b>Ditolak</b></h3>';
                        echo '<p>Alasan penolakan: ' . $pendaftaran['reason_rejection'] . '</p>';
                    } ?>
                    <h3 class="title"></h3>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <h4>Jadwal Magang</h4>
                </div>
                <div class="card-content">
                    <?php
                    $data_sql = $conn->query("SELECT status_pendaftaran FROM detail_pendaftaran WHERE id_user = $id");
                    $status_sql = $data_sql->fetch_assoc();
                    $jadwal = $conn->query("SELECT senin, selasa, rabu, kamis, jumat FROM jadwal WHERE Id = $id_dinas");
                    $jadwal_sql = $jadwal->fetch_assoc();
                    if ($status_sql['status_pendaftaran'] == 0) {
                        echo '<h5><b>Menunggu</b></h5>';
                    } elseif ($status_sql['status_pendaftaran'] == 1) {
                        echo '<h5><b>Senin:</b> ' . $jadwal_sql['senin'] . '</h5>';
                        echo '<h5><b>Selasa:</b> ' . $jadwal_sql['selasa'] . '</h5>';
                        echo '<h5><b>Rabu:</b> ' . $jadwal_sql['rabu'] . '</h5>';
                        echo '<h5><b>Kamis:</b> ' . $jadwal_sql['kamis'] . '</h5>';
                        echo '<h5><b>Jumat:</b> ' . $jadwal_sql['jumat'] . '</h5>';
                    } else {
                        echo ' ';
                    }
                    ?>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <h4>Tanggal Masuk - Tanggal Keluar</h4>
                </div>
                <div class="card-content">
                    <?php
                    $sql_status = $conn->query("SELECT status_pendaftaran FROM detail_pendaftaran WHERE id_user = $id");
                    $status = $sql_status->fetch_assoc();
                    $sql_data = $conn->query("SELECT tgl_masuk, tgl_keluar FROM pendaftaran WHERE Id = $id_user");
                    $pendaftaran_data = $sql_data->fetch_assoc(); 
                        if ($status['status_pendaftaran'] == 0) {
                            echo '<h5><b>Menunggu</b></h5>';
                        } elseif ($status['status_pendaftaran'] == 1) {
                            echo '<h5><b>Tanggal Masuk:</b> ' . $pendaftaran_data['tgl_masuk'] . '</h5>';
                            echo '<h5><b>Tanggal Keluar:</b> ' . $pendaftaran_data['tgl_keluar'] . '</h5>';
                        } else {
                            echo ' ';
                        }
                    }
                    ?>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
<?php
?>