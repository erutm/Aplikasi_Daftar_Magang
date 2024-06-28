<h1>Ubah Data Dinas</h1>

<?php

$query 		=	"SELECT * FROM dinas where Id = $id";

$exec  		= 	mysqli_query($conn, $query);

if ($exec) {
	$data 	= mysqli_fetch_array($exec);
} else {
	echo mysqli_error($conn);
}


if (isset($_POST['submit'])) {

	$_SESSION['message'] = "";

	$valid = true;

	foreach ($_POST as $key => $val) {
		${$key} = $val;
	}

	if ($nama_dinas == "") {
		$valid = false;
	}

	if ($nama_bidang == "") {
		$valid = false;
	}

	if ($valid == false) {
		echo '<script>alert("Tidak boleh ada field yang kosong")</script>';
	} else {
		$query		=	"UPDATE dinas 
						SET nama_dinas = '$nama_dinas', nama_bidang = '$nama_bidang' 
						WHERE Id=$id";
		$exec 		=	mysqli_query($conn, $query);

		if ($exec) {
			$_SESSION['message'] = "Berhasil ubah data dinas";
			echo '<script>window.location = "index.php?page=26"</script>';
		} else {
			echo mysqli_error($conn);
		}
	}
}
?>

<div class="row">
	<div class="col-sm-12 col-md-8 col-lg-10 col-lg-offset-1">
		<div class="card" style="margin-top: 50px">
			<div class="card-header" data-background-color="gb">
				<h4 class="title"><b>Ubah data dinas</b></h4>
				<p class="category">Masukkan data dinas dengan benar</p>
			</div>
			<div class="card-content">
				<a href="index.php?page=26" class="btn btn-primary btn-md pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
				<h3 style="overflow: hidden;"><b>Data Dinas</b></h3>

				<form action="" method="post">
					<div class="form-group floating-label">
						<label for="nama">Nama Dinas</label>
						<input type="text" class="form-control" name="nama_dinas" value="<?php echo $data['nama_dinas'] ?>">
					</div>

					<div class="form-group floating-label">
						<label for="nama">Nama Bidang</label>
						<input type="text" class="form-control" name="nama_bidang" value="<?php echo $data['nama_bidang'] ?>">
					</div>


					<button type="submit" name="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> &nbsp;Simpan</button>
					<button type="reset" class="btn btn-warning pull-right"><i class="fa fa-eraser"></i> Bersihkan</button>
				</form>

			</div>
		</div>
	</div>
</div>