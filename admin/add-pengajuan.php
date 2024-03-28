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
		<title>Tambah Pengajuan - <?php echo $title ?></title>
		<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="../css/sb-admin-2.min.css" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
	</head>
	<body id="page-top">
		<div id="wrapper">
			<?php include('sidebar.php')?>
			<div id="content-wrapper" class="d-flex flex-column">
				<div id="content">
					<?php include('navbar.php')?>
					<div class="container-fluid">
						<div class="my-3 bg-white rounded  border p-4">
							<h2 class="h3 mb-3 text-gray-800 font-weight-bold">Tambah Pengajuan</h2>
							<?php include('template-alert.php')  ?>
							<form action="handler/handler-add-pengajuan.php" method="POST" enctype="multipart/form-data" id="form-pengajuan">
								<div class="form-group">
									<label for="nama_instansi">Nama Instansi:</label>
									<select id="nama_instansi" class="form-control" name="nama_instansi">
									<?php
										// Ambil data instansi dari tabel instansi
										require('../koneksi.php');
										$query_instansi = "SELECT id_instansi, nama_instansi FROM instansi";
										$result_instansi = mysqli_query($koneksi, $query_instansi);
										
										// Tampilkan data instansi dalam opsi dropdown
										if (mysqli_num_rows($result_instansi) > 0) {
										    while ($row_instansi = mysqli_fetch_assoc($result_instansi)) {
										        echo "<option value='" . $row_instansi['id_instansi'] . "'>" . $row_instansi['nama_instansi'] . "</option>";
										    }
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="srt_pengajuan">Surat Pengajuan:</label>
									<div class="custom-file">
										<input type="file" id="srt_pengajuan" class="custom-file-input" name="srt_pengajuan[]" required accept=".pdf" onchange="displayFileName('srt_pengajuan', 'srt_pengajuan_placeholder')">
										<label class="custom-file-label" id="srt_pengajuan_placeholder" for="srt_pengajuan">Pilih file...</label>
									</div>
								</div>
								<div class="form-group">
									<label for="srt_balasan">Surat Balasan:</label>
									<div class="custom-file">
										<input type="file" id="srt_balasan" class="custom-file-input" name="srt_balasan[]" required accept=".pdf" onchange="displayFileName('srt_balasan', 'srt_balasan_placeholder')">
										<label class="custom-file-label" id="srt_balasan_placeholder" for="srt_balasan">Pilih file...</label>
									</div>
								</div>
								<div class="form-group">
    <label for="tahun">Tahun:</label>
    <select id="tahun" class="form-control" name="tahun[]" required>
	<?php
    $current_year = date("Y");
    $start_year = 2020; // Mulai dari tahun 2020
    for ($i = $current_year; $i >= $start_year; $i--) {
        echo "<option value='$i'>$i</option>";
    }
?>
    </select>
</div>

								<div class="form-group">
									<label for="keterangan">Keterangan:</label>
									<textarea id="keterangan" class="form-control" name="keterangan[]" rows="3" placeholder="Masukkan keterangan.." required></textarea>
								</div>
								<div id="form-tambahan"></div>
								<button type="button" class="btn btn-sm btn-success" id="btn-tambah-form"> <i class="fas fa-fw fa-plus"></i></button>
								<!-- Tombol Submit dan Kembali -->
								<input class="btn btn-sm btn-primary shadow-sm" type="submit" value="Submit">
								<a href="data-pengajuan.php" class="btn btn-sm btn-danger shadow-sm">Kembali</a>
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
		<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="../js/sb-admin-2.min.js"></script>
		<script>
			$(document).ready(function(){
			    var formCounter = 1; // Inisialisasi counter formulir
			
			    $("#btn-tambah-form").click(function(){
			        formCounter++;
			        var badgeColorClass = formCounter % 2 === 0 ? 'bg-primary' : 'bg-success'; // Bergantian antara warna background
			        var textColorClass = formCounter % 2 === 0 ? 'text-white' : 'text-white'; // Bergantian antara warna teks
			        var hrColorClass = formCounter % 2 === 0 ? 'hr-primary' : 'hr-success'; // Bergantian antara warna hr
			        var html = '<div class="form-tambahan">' +
    '<hr class="custom-hr ' + hrColorClass + '">' +
    '<div class="d-flex justify-content-between align-items-center mb-2">' +
    '<div class="badge ' + badgeColorClass + ' ' + textColorClass + '">Pengajuan #' + formCounter + '</div>' +
    '<button type="button" class="btn btn-sm btn-danger btn-hapus-form"><i class="fas fa-fw fa-trash"></i></button>' +
    '</div>' +
    '<div class="form-group">' +
    '<label for="srt_pengajuan">Surat Pengajuan #' + formCounter + ':</label>' +
    '<div class="custom-file">' +
    '<input type="file" id="srt_pengajuan_' + formCounter + '" class="custom-file-input" name="srt_pengajuan[]" required accept=".pdf" onchange="displayFileName(\'srt_pengajuan_' + formCounter + '\', \'srt_pengajuan_placeholder_' + formCounter + '\')">' +
    '<label class="custom-file-label" id="srt_pengajuan_placeholder_' + formCounter + '" for="srt_pengajuan_' + formCounter + '">Pilih file...</label>' +
    '</div>' +
    '</div>' +
    '<div class="form-group">' +
    '<label for="srt_balasan">Surat Balasan #' + formCounter + ':</label>' +
    '<div class="custom-file">' +
    '<input type="file" id="srt_balasan_' + formCounter + '" class="custom-file-input" name="srt_balasan[]" required accept=".pdf" onchange="displayFileName(\'srt_balasan_' + formCounter + '\', \'srt_balasan_placeholder_' + formCounter + '\')">' +
    '<label class="custom-file-label" id="srt_balasan_placeholder_' + formCounter + '" for="srt_balasan_' + formCounter + '">Pilih file...</label>' +
    '</div>' +
    '</div>' +
    '<div class="form-group">' +
    '<label for="tahun">Tahun Pengajuan #' + formCounter + ':</label>' +
    '<select class="form-control" name="tahun[]" required>' +
    '<?php
    $current_year = date("Y");
	$start_year = 2020;
    for ($i = $current_year; $i >= $start_year; $i--) {
        echo "<option value=\'$i\'>$i</option>";
    }
    ?>' +
    '</select>' +
    '</div>' +
    '<div class="form-group">' +
    '<label for="keterangan">Keterangan Pengajuan #' + formCounter + ':</label>' +
    '<textarea class="form-control" name="keterangan[]" required rows="3" placeholder="Masukkan keterangan.."></textarea>' +
    '</div>' +
    '</div>';

$("#form-tambahan").append(html);

			    });
			
			    // Event delegation untuk menangani klik tombol Hapus
			    $("#form-tambahan").on("click", ".btn-hapus-form", function(){
			        if(formCounter > 1){
			            $(this).closest(".form-tambahan").remove(); // Hapus formulir terkait
			            formCounter--;
			        }
			    });
			});
		</script>
		<script>
			function displayFileName(inputId, placeholderId) {
				const input = document.getElementById(inputId);
				const placeholder = document.getElementById(placeholderId);
				const fileName = input.files[0] ? input.files[0].name : '';
				placeholder.innerText = fileName;
			}
		</script>

	</body>
</html>