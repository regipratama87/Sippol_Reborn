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
		mysqli_close($koneksi);
		?>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Export Presensi -
			<?php echo $title ?>
		</title>
		<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="../css/sb-admin-2.min.css" rel="stylesheet">
		<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
	</head>
	<body id="page-top">
		<div id="wrapper">
			<?php include('sidebar.php')?>
			<div id="content-wrapper" class="d-flex flex-column">
				<div id="content">
					<?php include('navbar.php')?>
					<div class="container-fluid">
						<div class="my-3 bg-white rounded  border p-4">
						<h2 class="h3 mb-3 text-gray-800 font-weight-bold">Export Presensi</h2>
						<?php include('template-alert.php') ?>
						<form action="handler/handler-export.php" method="post">
							<div class="row">
								<div class="col-lg-6 col-12">
									<div class="form-group">
										<label for="year">Tahun:</label>
										<select class="form-control" name="selected_year" id="year">
											<option value="">Semua</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-12">
									<div class="form-group">
										<label for="month">Bulan:</label>
										<select class="form-control" name="selected_month" id="month">
											<option value="">-- Mohon pilih bulan --</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6 col-12">
									<div class="form-group">
										<label for="date">Tanggal:</label>
										<input type="number" min="1" max="31" class="form-control" name="selected_date" id="date" placeholder="Masukkan tanggal...">
									</div>
								</div>
								<div class="col-lg-6 col-12">
									<div class="form-group">
										<label for="institution">Instansi:</label>
										<select class="form-control" name="selected_institution" id="institution">
										<?php
											require('../koneksi.php');
											
											$query = "SELECT nama_instansi  as data_asal FROM instansi";
											$result = $koneksi->query($query);
											
											    echo "<option value=''>-- Mohon pilih instansi --</option>";
											
											if ($result->num_rows > 0) {
											    while ($row = $result->fetch_assoc()) {
											        echo "<option value='" . $row['data_asal'] . "'>" . $row['data_asal'] . "</option>";
											    }
											} else {
											    echo "<option value=''>Tidak ada data</option>";
											}
											
											$koneksi->close();
											?>
										</select>
									</div>
								</div>
							</div>
							<span type="show" class="btn bg-success btn-show btn-sm text-white">Show</span>
							<button type="submit" class="btn bg-primary btn-export btn-sm text-white">Export</button>
						</form>
						<table id="dataTable" class="table table-striped table-bordered mt-3" style="width:100%">
							<thead>
								<tr>
									<th>ID</th>
									<th>Nama</th>
									<th>NPM</th>
									<th>Instansi</th>
									<th>Tanggal</th>
									<th>Status</th>
									<th>Deskripsi</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<script>
							var yearDropdown = document.getElementById('year');
							var monthDropdown = document.getElementById('month');
							
							var currentDate = new Date();
							var currentYear = currentDate.getFullYear();
							
							for (var i = currentYear; i >= currentYear - 10; i--) {
							    var option = document.createElement('option');
							    option.text = i;
							    option.value = i;
							    yearDropdown.add(option);
							}
							
							var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
							for (var j = 0; j < 12; j++) {
							    var option = document.createElement('option');
							    option.text = monthNames[j];
							    option.value = j + 1; 
							    monthDropdown.add(option);
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
		<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
		<script src="../js/sb-admin-2.min.js"></script>
		<script>
			$('.btn-export').hide();
			   $('.btn-show').click(function() {
			$('.btn-export').show();
			
			$.ajax({
			    url: 'handler/handler-show-table.php',
			    method: 'POST',
			    data: $('form').serialize(),
			    dataType: 'json', 
			    success: function(response) {
			        if (response.success) {
			            $('#dataTable tbody').empty(); 
			            $.each(response.data, function(index, item) {
			                var newRow = '<tr>' +
			                    '<td>' + item.id_data + '</td>' +
			                    '<td>' + item.data_nama + '</td>' +
			                    '<td>' + item.data_npm + '</td>' +
			                    '<td>' + item.data_asal + '</td>' +
			                    '<td>' + item.data_tanggal + '</td>' +
			                    '<td>' + (item.data_status == 5 ? 'in' : (item.data_status == 6 ? 'out' : item.data_status)) + '</td>' +
			                    '<td>' + item.data_deskripsi + '</td>' +
			                    '</tr>';
			                $('#dataTable tbody').append(newRow);
			            });
			        } else {
			            console.error('Tidak dapat memperoleh data.');
			        }
			    },
			    error: function(xhr, status, error) {
			        console.error(xhr.responseText);
			    }
			});
			});
		</script>
	</body>
</html>