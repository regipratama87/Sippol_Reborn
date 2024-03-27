<!DOCTYPE html>
<html lang="en">
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
		
		// Proses Update Title
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		    $newTitle = $_POST['new_title'];
		
		    $queryUpdate = "UPDATE configs SET title = '$newTitle'";
		    if (mysqli_query($koneksi, $queryUpdate)) {
		        $title = $newTitle;
		        $_SESSION['success_message_admin'] = "Title berhasil diperbarui.";
		        // header("Location: {$_SERVER['PHP_SELF']}"); 
		    } else {
		        $_SESSION['error_message_admin'] = "Gagal memperbarui title: " . mysqli_error($koneksi);
		        // header("Location: {$_SERVER['PHP_SELF']}"); 
		    }
		
		    mysqli_close($koneksi);
		}
		?>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Konfigurasi -
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
							<span class="h3 mb-3 text-gray-800 font-weight-bold">Konfigurasi</span>
							<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="mt-3">
								<?php include('template-alert.php'); ?>
								<div class="form-group">
									<label for="">Title : </label>
									<input type="text" class="form-control" name="new_title" value="<?php echo $title; ?>">
								</div>
								<button type="submit" class="btn btn-primary">Simpan</button>
							</form>
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