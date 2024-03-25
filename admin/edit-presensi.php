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
	
	if(isset($_GET['id'])) {
	    $id = $_GET['id'];
	    
	
	    $query = "SELECT * FROM presensi WHERE id_data = $id";
	    $result = mysqli_query($koneksi, $query);
	
	    if(mysqli_num_rows($result) == 1) {
	        $row = mysqli_fetch_assoc($result);
	        $data_nama = $row['data_nama'];
	        $data_npm = $row['data_npm'];
	        $data_asal = $row['data_asal'];
	        $data_tanggal = $row['data_tanggal'];
	        $data_status = $row['data_status'];
	        $data_deskripsi = $row['data_deskripsi'];
	    } else {
	        echo "Data tidak ditemukan.";
	        exit();
	    }
	
	    mysqli_close($koneksi);
	} else {
	    echo "ID data tidak ditemukan.";
	    exit();
	}
	?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Edit Presensi -
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
							<form method="POST" action="handler/handler-edit-presensi.php">
								<h2 class="h3 mb-3 text-gray-800 font-weight-bold">Form Edit Presensi</h2>
								<?php include('template-alert.php') ?>
								<input type="hidden" name="id" value="<?php echo $id; ?>">
								<div class="form-group">
									<label>Nama:</label>
									<input type="text" class="form-control" name="data_nama" readonly value="<?php echo $data_nama; ?>">
								</div>
								<div class="form-group">
									<label>NPM:</label>
									<input type="text" class="form-control" name="data_npm" readonly value="<?php echo $data_npm; ?>">
								</div>
								<div class="form-group">
									<label>Asal:</label>
									<input type="text" class="form-control" name="data_asal" readonly value="<?php echo $data_asal; ?>">
								</div>
								<div class="form-group">
									<label>Tanggal:</label>
									<input type="datetime-local" class="form-control" name="data_tanggal" value="<?php echo date('Y-m-d\TH:i', strtotime($data_tanggal)); ?>">
								</div>
								<div class="form-group">
									<label>Status:</label>
									<select class="form-control" name="data_status">
										<option value="5" <?php if ($data_status == 5) echo 'selected'; ?>>In</option>
										<option value="6" <?php if ($data_status == 6) echo 'selected'; ?>>Out</option>
									</select>
								</div>
								<div class="form-group">
									<label>Deskripsi:</label>
									<input type="text" class="form-control" name="data_deskripsi" value="<?php echo $data_deskripsi; ?>">
								</div>
								<div>
									<div class="mt-3">
										<button type="submit"  class="btn btn-sm btn-primary shadow-sm">Edit</button>
										<a href="data-presensi.php" class="btn btn-sm btn-danger shadow-sm" >Kembali</a>
									</div>
								</div>
							</form>
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
