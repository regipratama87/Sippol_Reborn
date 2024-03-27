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
		<title>Tambah Akun -
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
					<div class="container mt-4">
						<?php
							require '../koneksi.php';
							
							$id_user = $username = $nama = $password = $asal = $mulai_magang = $akhir_magang = $status = '';
							
							if (isset($_GET['id_user'])) {
							    $id_user = $_GET['id_user'];
							
							    $_SESSION['id_user'] = $id_user;
							
							    $sql = "SELECT u.*, i.nama_instansi 
							            FROM user u 
							            INNER JOIN instansi i ON u.id_instansi = i.id_instansi
							            WHERE u.id_user = '$id_user'";
							    $result = $koneksi->query($sql);
							
							    if ($result->num_rows == 1) {
							        $row = $result->fetch_assoc();
							        $username = $row['username'];
							        $nama = $row['nama'];
							        $password = $row['password'];
							        $asal = $row['nama_instansi']; 
							        $mulai_magang = $row['mulai_magang'];
							        $akhir_magang = $row['akhir_magang'];
							        $status = $row['status'];
							    } else {
							        echo "Pemagang tidak ditemukan.";
							        exit();
							    }
							}
							?>
						<div class="my-3 bg-white rounded  border p-4">
							<h2 class="h3 mb-3 text-gray-800">Add Pemagang</h2>
							<form method="post" action="handler/handler-add-pemagang.php" id="add-pemagang" onsubmit="simpanTemplate()">
								<?php include('template-alert.php')?>
								<div class="form-group">
									<label>Username:</label>
									<input class="form-control" type="text" name="username" required placeholder="Masukkan username..">
								</div>
								<div class="form-group">
									<label>Password:</label>
									<input class="form-control" type="text" name="password" required placeholder="Masukkan password..">
								</div>
								<div class="form-group">
									<label>Nama: (Opsional)</label>
									<input class="form-control" type="text" name="nama" placeholder="Masukkan nama..">
								</div>
								<div class="form-group">
									<label>NPM: </label>
									<input class="form-control" type="text" required name="npm" placeholder="Masukkan NPM..">
								</div>
								<div class="form-group">
									<label>Instansi :</label>
									<select class="form-control"  required name="asal">
									<?php
										$sql_instansi = "SELECT nama_instansi FROM instansi";
										$result_instansi = $koneksi->query($sql_instansi);
										echo "<option value='0' disabled readonly selected required>-- Pilih instansi --</option>";
										if ($result_instansi) {
										    if ($result_instansi->num_rows > 0) {
										        while ($row_instansi = $result_instansi->fetch_assoc()) {
										            echo "<option value='" . $row_instansi['nama_instansi'] . "'>" . $row_instansi['nama_instansi'] . "</option>";
										        }
										    } else {
										        echo "<option value=''>Tidak ada data instansi</option>";
										    }
										} else {
										    echo "Error: " . $koneksi->error;
										}
										?>
									</select>
								</div>
								<style>
								</style>
								<div class="form-group">
									<label>Mulai Magang:</label>
									<input class="form-control" required type="datetime-local" name="mulai_magang" id="date">
								</div>
								<div class="form-group">
									<label>Akhir Magang:</label>
									<input class="form-control" required type="datetime-local"name="akhir_magang" id="date">
								</div>
								<div class="form-group">
									<label>Status:</label>
									<label class="radio-inline">
									<input type="radio" required name="status" value="1" checked> Aktif
									</label>
									<label class="radio-inline ml-3">
									<input type="radio" required name="status" value="0"> Nonaktif
									</label>
								</div>
								<div class="form-group mt-n3 mb-3">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="simpan_template">
										<label class="form-check-label" for="simpan_template">
											Simpan "Mulai Magang dan Akhir Magang"?
										</label>
									</div>
								</div>
								<button type="submit" class="btn btn-sm btn-primary shadow-sm">Submit</button>
								<a href="data-pemagang.php" class="btn btn-sm btn-danger shadow-sm">Kembali</a>
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
		<script>
			function tampilkanTemplate() {
			var asal = sessionStorage.getItem('asal');
			var mulaiMagang = sessionStorage.getItem('mulaiMagang');
			var akhirMagang = sessionStorage.getItem('akhirMagang');
			var status = sessionStorage.getItem('status');
			if (asal && mulaiMagang && akhirMagang && status) {
			    document.getElementsByName('asal')[0].value = asal;
			    document.getElementsByName('mulai_magang')[0].value = mulaiMagang;
			    document.getElementsByName('akhir_magang')[0].value = akhirMagang;
			    document.querySelector('input[name="status"][value="' + status + '"]').checked = true;
			}
			}
			window.onload = function () {
			tampilkanTemplate();
			};
			
			function simpanTemplate() {
			var checkboxSimpan = document.getElementById('simpan_template');
			if (checkboxSimpan.checked) {
			    var asal = document.getElementsByName('asal')[0].value;
			    var mulaiMagang = document.getElementsByName('mulai_magang')[0].value;
			    var akhirMagang = document.getElementsByName('akhir_magang')[0].value;
			    var status = document.querySelector('input[name="status"]:checked').value;
			    sessionStorage.setItem('asal', asal);
			    sessionStorage.setItem('mulaiMagang', mulaiMagang);
			    sessionStorage.setItem('akhirMagang', akhirMagang);
			    sessionStorage.setItem('status', status);
			} else {
			    hapusTemplate();
			}
			}
			function hapusTemplate() {
			sessionStorage.removeItem('asal');
			sessionStorage.removeItem('mulaiMagang');
			sessionStorage.removeItem('akhirMagang');
			sessionStorage.removeItem('status');
			}
		</script>
	</body>
</html>