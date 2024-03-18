<!DOCTYPE html>
<?php
	session_start();
	require('../koneksi.php');
	$query = "SELECT title FROM configs";
	$result = mysqli_query($koneksi, $query);
	$row = mysqli_fetch_assoc($result);
	$title =  $row['title'];
	
	if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] === false) {
	    header("Location: ../xlogin.php");
	    exit(); 
	}
	
	// Pastikan ada parameter id yang dikirim melalui URL
	if (!isset($_GET['id'])) {
	    header("Location: data-pengajuan.php"); // Redirect jika tidak ada id
	    exit();
	}
	
	// Tangkap id pengajuan dari URL
	$id_pengajuan = $_GET['id'];
	
	// Query untuk mengambil data pengajuan berdasarkan id
	$query = "SELECT * FROM pengajuan WHERE id_pengajuan = $id_pengajuan";
	$result = mysqli_query($koneksi, $query);
	
	if (!$result) {
	    die("Error: " . mysqli_error($koneksi));
	}
	
	// Periksa apakah pengajuan ditemukan
	if (mysqli_num_rows($result) == 0) {
	    echo "Pengajuan tidak ditemukan.";
	    exit();
	}
	
	// Ambil data pengajuan dari hasil query
	$row = mysqli_fetch_assoc($result);
	$file_pengajuan = $row['srt_pengajuan'];
	$file_balasan = $row['srt_balasan'];
	$id_instansi = $row['id_instansi'];
	$tahun = $row['tahun'];
	$keterangan = $row['keterangan'];
	
	// Proses form jika ada data yang dikirimkan
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    // Tangkap data dari formulir
	    $id_instansi = $_POST['nama_instansi'];
	    $tahun = $_POST['tahun'];
	    $keterangan = $_POST['keterangan'];
	
	    // Lakukan update data pengajuan ke dalam database
	    $update_query = "UPDATE pengajuan SET id_instansi = '$id_instansi', tahun = '$tahun', keterangan = '$keterangan' WHERE id_pengajuan = $id_pengajuan";
	    $update_result = mysqli_query($koneksi, $update_query);
	
	    if ($update_result) {
	        // Redirect ke halaman data-pengajuan.php jika berhasil diupdate
	        header("Location: data-pengajuan.php");
	        exit();
	    } else {
	        echo "Gagal mengupdate data pengajuan.";
	    }
	}
	
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
							<h2 class="h3 mb-3 text-gray-800 font-weight-bold">Edit Pengajuan</h2>
							<form action="handler/handler-edit-pengajuan.php" method="POST" enctype="multipart/form-data">
								<?php include('template-alert.php') ?>
								<input type="hidden" name="id_pengajuan" value="<?php echo $id_pengajuan; ?>">
								<div class="form-group">
									<label for="nama_instansi">Nama Instansi:</label>
									<!-- Di sini Anda bisa memilih instansi dari dropdown atau mengizinkan pengguna memasukkan instansi secara manual -->
									<!-- Contoh dropdown -->
									<select name="nama_instansi" id="nama_instansi" class="form-control">
									<?php
										require('../koneksi.php');
										$query_instansi = "SELECT * FROM instansi";
										$result_instansi = mysqli_query($koneksi, $query_instansi);
										while ($row_instansi = mysqli_fetch_assoc($result_instansi)) {
										    // Tandai instansi yang sedang diedit
										    $selected = ($row_instansi['id_instansi'] == $id_instansi) ? "selected" : "";
										    echo "<option value='" . $row_instansi['id_instansi'] . "' $selected>" . $row_instansi['nama_instansi'] . "</option>";
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="srt_pengajuan">Surat Pengajuan:</label>
									<div class="custom-file">
										<input type="file" id="srt_pengajuan" class="custom-file-input" name="srt_pengajuan"  accept=".pdf" onchange="displayFileName('srt_pengajuan', 'srt_pengajuan_placeholder')">
										<label class="custom-file-label" id="srt_pengajuan_placeholder" for="srt_pengajuan"><?php echo basename($file_pengajuan); ?></label>
									</div>
								</div>
								<div class="form-group">
									<label for="srt_balasan">Surat Balasan:</label>
									<div class="custom-file">
										<input type="file" id="srt_balasan" class="custom-file-input" name="srt_balasan"  accept=".pdf" onchange="displayFileName('srt_balasan', 'srt_balasan_placeholder')">
										<label class="custom-file-label" id="srt_balasan_placeholder" for="srt_balasan"><?php echo basename($file_balasan); ?></label>
									</div>
								</div>
								<div class="form-group">
									<label for="tahun">Tahun:</label>
									<input type="text" id="tahun" name="tahun" class="form-control" value="<?php echo $tahun; ?>">
								</div>
								<div class="form-group">
									<label for="keterangan">Keterangan:</label>
									<textarea id="keterangan" name="keterangan" class="form-control" rows="3"><?php echo $keterangan; ?></textarea>
								</div>
								<input type="submit" value="Simpan" class="btn btn-primary btn-sm">
								<a href="data-pengajuan.php" class="btn btn-sm btn-danger shadow-sm">Kembali</a>
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
		<script>
			function displayFileName(inputId, placeholderId) {
				const input = document.getElementById(inputId);
				const placeholder = document.getElementById(placeholderId);
				const fileName = input.files[0] ? input.files[0].name : 'Pilih file...';
				placeholder.innerText = fileName;
			}
		</script>

	</body>
</html>