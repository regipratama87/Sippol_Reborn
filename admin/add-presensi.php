<!DOCTYPE html>
<?php
	session_start();
	if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] === false) {
	    header("Location: login.php");
	    exit(); 
	}
	require('../koneksi.php');
	$query = "SELECT title FROM configs";
	$result = mysqli_query($koneksi, $query);
	$row = mysqli_fetch_assoc($result);
	$title =  $row['title'];
	mysqli_close($koneksi);
	?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Tambah Presensi - <?php echo $title ?></title>
		<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="../css/sb-admin-2.min.css" rel="stylesheet">
	</head>
	<body id="page-top">
		<div id="wrapper">
			<?php include('sidebar.php')?>
			<div id="content-wrapper" class="d-flex flex-column">
				<div id="content">
					<?php include('navbar.php')?>
					<div class="container-fluid">
						<div class="my-3 bg-white rounded  border p-4">
							<h2 class="h3 mb-3 text-gray-800 font-weight-bold">Form Tambah Presensi</h2>
							<?php include('template-alert.php')?>
							<form action="handler/handler-add-presensi.php" method="POST">
								<div class="row">
									<div class="col-12 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="id_user">ID User</label>
											<select class="form-control" id="id_user" name="id_user" onchange="getData(this.value)">
												<option value="0">--Pilih ID user--</option>
												<?php
													require('../koneksi.php');
													$sql = "SELECT id_user, nama FROM user WHERE status = 1";
													$result = $koneksi->query($sql);
													if ($result->num_rows > 0) {
													    while ($row = $result->fetch_assoc()) {
													        echo "<option value='" . $row['id_user'] . "'>" . $row['id_user'] . " - " . $row['nama'] . "</option>";
													    }
													}
													?>
											</select>
										</div>
									</div>
									<div class="col-12 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="data_nama">Nama :</label>
											<input class="form-control" type="text" id="data_nama" name="data_nama" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="data_npm">NPM :</label>
											<input class="form-control" type="text" id="data_npm" name="data_npm" readonly>
										</div>
									</div>
									<div class="col-12 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="data_asal">Asal Instansi : </label>
											<input class="form-control" type="text" id="data_asal" name="data_asal" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="data_tanggal">Tanggal :</label>
											<input class="form-control" type="date" id="data_tanggal" name="data_tanggal" required>
										</div>
									</div>
									<div class="col-12 col-lg-6 col-md-6 col-sm-12">
										<div class="form-group">
											<label for="data_status">Status : </label>
											<select id="data_status" class="form-control" name="data_status" required>
												<option value="5">In</option>
												<option value="6">Out</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="data_deskripsi">Deskripsi : </label>
									<textarea class="form-control" id="data_deskripsi" name="data_deskripsi" rows="4" cols="50" required></textarea>
								</div>
								<div class="form-group">
									<input class="btn btn-sm btn-primary shadow-sm" type="submit" value="Submit">
									<a href="data-presensi.php" class="btn btn-sm btn-danger shadow-sm">Kembali</a>
								</div>
							</form>
							<script>
								function getData(idUser) {
								    var xhr = new XMLHttpRequest();
								    xhr.open('GET', 'ajax-get-data.php?id_user=' + idUser, true);
								
								    xhr.onreadystatechange = function() {
								        if (xhr.readyState == 4 && xhr.status == 200) {
								            var response = JSON.parse(xhr.responseText);
								            document.getElementById('data_nama').value = response.nama;
								            document.getElementById('data_npm').value = response.npm;
								            document.getElementById('data_asal').value = response.nama_instansi;
								        }
								    };
								
								    xhr.send();
								}
							</script>
						</div>
					</div>
				</div>
				<footer class="sticky-footer bg-white border-top">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<span>Copyright &copy; <?php
								require('../koneksi.php');
								$query = "SELECT title FROM configs";
								$result = mysqli_query($koneksi, $query);
								$row = mysqli_fetch_assoc($result);
								echo $row['title'];
								mysqli_close($koneksi);
								?> 2024</span>
						</div>
					</div>
				</footer>
			</div>
		</div>
		<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
		</a>
		<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						<a class="btn btn-primary" href="logout.php">Logout</a>
					</div>
				</div>
			</div>
		</div>
		<script src="../vendor/jquery/jquery.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="../js/sb-admin-2.min.js"></script>
	</body>
</html>
