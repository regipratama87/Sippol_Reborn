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
		<title>Edit Instansi -
			<?php echo $title ?>
		</title>
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
							<?php
								require '../koneksi.php';
								
								if(isset($_GET['id'])) {
								    $id_instansi = $_GET['id'];
								
								    $query = "SELECT * FROM instansi WHERE id_instansi = '$id_instansi'";
								    $result = mysqli_query($koneksi, $query);
								
								    if ($result) {
								        if (mysqli_num_rows($result) > 0) {
								            $row = mysqli_fetch_assoc($result);
								            $nama_instansi = $row['nama_instansi'];
								            $alamat_instansi = $row['alamat_instansi'];
								?>
							<h2 class="h3 mb-3 text-gray-800 font-weight-bold">Edit Instansi</h2>
							<form action="handler/handler-edit-instansi.php" method="POST">
								<?php include('template-alert.php')?>
								<input type="hidden" name="id_instansi" value="<?php echo $id_instansi; ?>">
								<div class="form-group">
									<label for="nama_instansi">Nama Instansi:</label>
									<input type="text" id="nama_instansi" name="nama_instansi" class="form-control" value="<?php echo $nama_instansi; ?>">
								</div>
								<div class="form-group">
									<label for="alamat_instansi">Alamat Instansi:</label>
									<input type="text" id="alamat_instansi" name="alamat_instansi" class="form-control" value="<?php echo $alamat_instansi; ?>">
								</div>
								<input type="submit" value="Simpan" class="btn btn-primary btn-sm">
								<a href="data-instansi.php" class="btn btn-sm btn-danger shadow-sm">Kembali</a>
							</form>
							<?php
								} else {
								    echo "Data instansi tidak ditemukan.";
								}
								} else {
								echo "Error: " . mysqli_error($koneksi);
								}
								
								mysqli_close($koneksi);
								} else {
								echo "ID Instansi tidak tersedia.";
								}
								?>
						</div>
					</div>
				</div>
				<?php include('footer.php')?>
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