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
		<title>Data Pengajuan -
			<?php echo $title ?>
		</title>
		<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="../css/sb-admin-2.min.css" rel="stylesheet">
		<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<style>
			.popup {
			display: none; 
			position: fixed;
			z-index: 9999;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			overflow: auto;
			background-color: rgba(0, 0, 0, 0.4); 
			}
			.popup-content {
			background-color: #fefefe;
			margin: 10% auto; 
			padding: 20px;
			border: 1px solid #888;
			width: 100%;
			max-width: max-content; 
			border-radius: 12px;
			position: relative;
			}
			.close {
			color: #aaa;
			float: right;
			font-size: 28px;
			font-weight: bold;
			}
			.close:hover,
			.close:focus {
			color: black;
			text-decoration: none;
			cursor: pointer;
			}
		</style>
	</head>
	<body id="page-top">
		<div id="wrapper">
			<?php include('sidebar.php')?>
			<div id="content-wrapper" class="d-flex flex-column">
				<div id="content">
					<?php include('navbar.php')?>
					<div class="container-fluid">
						<div class="my-3 bg-white rounded  border p-4">
							<div class="mt-0">
								<div class="d-sm-flex align-items-center justify-content-between mb-4">
									<span class="h3 mb-0 text-gray-800 font-weight-bold">Data Pengajuan</span>
									<div class="d-flex "> <a href="add-pengajuan.php" class="d-sm-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2 mt-2 mt-sm-0"><i
										class="fas fa-plus fa-sm text-white-50 mr-2"></i> Tambah Pengajuan</a>
										<a href="handler/handler-export-pengajuan.php" class="d-sm-none d-sm-inline-block btn btn-sm btn-success shadow-sm mr-2 mt-2 mt-sm-0"><i
										class="fas fa-download fa-sm text-white-50 mr-2"></i> Export Semua Data</a>
										<a href="javascript:void(0)" id="generateReport" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50 mr-2"></i> Generate Screenshot</a></div>
									<script>
										var scriptElement=document.createElement("script");scriptElement.src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js",document.head.appendChild(scriptElement),document.getElementById("generateReport").addEventListener("click",(function(){html2canvas(document.body,{onrendered:function(e){var t=e.toDataURL("image/png"),n=new Date,a=String(n.getDate()).padStart(2,"0"),c=String(n.getMonth()+1).padStart(2,"0"),r="report_"+n.getFullYear()+"-"+c+"-"+a+".png",d=document.createElement("a");d.download=r,d.href=t,d.click()}})}));
									</script>
								</div>
								<?php include('template-alert.php') ?>
								<div class="table-responsive">
									<table id="dataTable" class="table table-striped display">
										<thead>
											<tr>
												<th>No</th>
												<th>Instansi</th>
												<th data-orderable="false">Pengajuan</th>
												<th data-orderable="false">Balasan</th>
												<th>Tahun</th>
												<th>Keterangan</th>
												<th>Tanggal</th>
												<th data-orderable="false">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												require('../koneksi.php');
												
												$query = "SELECT p.*, i.nama_instansi
												        FROM pengajuan p
												        LEFT JOIN instansi i ON p.id_instansi = i.id_instansi ORDER BY id_pengajuan desc";
												
												$result = mysqli_query($koneksi, $query);
												
												if (!$result) {
												    die("Error: " . mysqli_error($koneksi));
												}
												
												if (mysqli_num_rows($result) > 0) {
												    $no = 1;
												    while ($row = mysqli_fetch_assoc($result)) {
												        echo "<tr>";
												        echo "<td>" . $row['id_pengajuan'] . "</td>";
												        echo "<td>" . $row['nama_instansi'] . "</td>";
												
												        echo "<td><a href='#' onclick=\"openPdfModal('" . $row['srt_pengajuan'] . "')\"> Lihat Berkas</a></td>";
												        echo "<td><a href='#' onclick=\"openPdfModal('" . $row['srt_balasan'] . "')\"> Lihat Berkas</a></td>";
												
												        echo "<td>" . $row['tahun'] . "</td>";
												        echo "<td>" . $row['keterangan'] . "</td>";
												        echo "<td>" . $row['timestamp'] . "</td>";
												
												        // Tambahkan tombol edit dan delete dengan mengirimkan id pengajuan
												        echo "<td class='d-inline-flex' style='width: max-content; height: max-content'><a href='edit-pengajuan.php?id=" . $row['id_pengajuan'] . "' class='btn btn-primary btn-sm mr-1'><i class='fas fa-pencil-alt'></i></a> ";
												        echo "<a href='javascript:void(0)' data-id=" . $row['id_pengajuan'] . " class='btn btn-danger btn-sm deleteBtn'><i class='fas fa-trash'></i></a></td>";
												
												        echo "</tr>";
												    }
												} else {
												    echo "<tr><td colspan='8'>Tidak ada data yang ditemukan</td></tr>";
												}
												
												mysqli_close($koneksi);
												?>
										</tbody>
										<tfoot>
											<tr>
												<th>-</th>
												<th>Instansi</th>
												<th>-</th>
												<th>-</th>
												<th>Tahun</th>
												<th>-</th>
												<th>-</th>
												<th>-</th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
						<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="ttl"></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body" id="userModalBody">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php include('footer.php')?>
			</div>
		</div>
		<a class="scroll-to-top rounded" href="#page-top"> <i class="fas fa-angle-up"></i> </a>
		<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
					</div>
					<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button> <a class="btn btn-primary" href="logout.php">Logout</a> 
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="pdfModalLabel">PDF Viewer</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<embed id="pdfEmbed" src="" type="application/pdf" width="100%" height="600px">
					</div>
				</div>
			</div>
		</div>
		<script>
			const deleteButtons = document.querySelectorAll('.deleteBtn');
			deleteButtons.forEach(button => {
			    button.addEventListener('click', function() {
			        const id = this.getAttribute('data-id');
			        Swal.fire({
			            title: 'Hapus Data',
			            text: 'Apakah Anda yakin ingin menghapus data ini?',
			            icon: 'warning',
			            showCancelButton: true,
			            confirmButtonColor: '#d33',
			            cancelButtonColor: '#3085d6',
			            confirmButtonText: 'Ya, Hapus'
			        }).then((result) => {
			            if (result.isConfirmed) {
			                window.location.href = 'handler/handler-delete-pengajuan.php?id=' + id;
			            }
			        });
			    });
			});
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
		<script src="../js/sb-admin-2.min.js"></script>
		<script>
			function openPdfModal(url) {
			  $('#pdfEmbed').attr('src', 'admin/' + url +"#navpanes=0");
			  $('#pdfModal').modal('show');
			}
			
		</script>
		<script>
			$(document).ready(function() {
				$('#dataTable').DataTable({	
					// order: [6,"desc"],
					order: [],
					initComplete: function () {
			        this.api().columns().every( function () {
			            var column = this;
			            var select;
			
			            if (column.index() == 4||  column.index() == 1) {
			                select = $('<select><option value=""></option></select>')
			                    .appendTo( $(column.footer()).empty() )
			                    .on( 'change', function () {
			                        var val = $.fn.dataTable.util.escapeRegex(
			                            $(this).val()
			                        );
			
			                        column
			                            .search( val ? '^'+val+'$' : '', true, false )
			                            .draw();
			                    } );
			
			                column.data().unique().sort().each( function ( d, j ) {
			                    select.append( '<option value="'+d+'">'+d+'</option>' )
			                } );
			            } else if (column.index() == 1 || column.index() == 5 || column.index() == 6) {
			                $('<input type="text" placeholder="Search"/>')
			                    .appendTo($(column.footer()).empty())
			                    .on('keyup change', function () {
			                        var val = $.fn.dataTable.util.escapeRegex(
			                            $(this).val()
			                        );
			                        column
			                            .search( val ? val : '', true, false )
			                            .draw();
			                    });
			            }
			        });
			    }
			});
			});       
		</script>
	</body>
</html>