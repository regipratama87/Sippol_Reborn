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
		<title>Data Instansi -
			<?php echo $title ?>
		</title>
		<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link href="../css/sb-admin-2.min.css" rel="stylesheet">
		<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
									<span class="h3 mb-0 text-gray-800 font-weight-bold">Data Instansi</span>
									<div class="d-flex "> <a href="add-instansi.php" class="d-sm-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-2 mt-2 mt-sm-0"><i
										class="fas fa-plus fa-sm text-white-50 mr-2"></i> Tambah Instansi</a><a href="javascript:void(0)" id="generateReport" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50 mr-2"></i> Generate Screenshot</a></div>
									<script>
										var scriptElement=document.createElement("script");scriptElement.src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js",document.head.appendChild(scriptElement),document.getElementById("generateReport").addEventListener("click",(function(){html2canvas(document.body,{onrendered:function(e){var t=e.toDataURL("image/png"),n=new Date,a=String(n.getDate()).padStart(2,"0"),c=String(n.getMonth()+1).padStart(2,"0"),r="report_"+n.getFullYear()+"-"+c+"-"+a+".png",d=document.createElement("a");d.download=r,d.href=t,d.click()}})}));
									</script>
								</div>
								<!-- <div class=" mb-5"> -->
								<?php include('template-alert.php') ?>
								<div class="table-responsive">
									<table id="dataTable" class="table table-striped">
										<thead>
											<tr>
												<th data-orderable="false">No</th>
												<th>Instansi</th>
												<th>Alamat</th>
												<th data-orderable="false">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												require('../koneksi.php');
												
												$query = "SELECT i.id_instansi as id_ins, i.nama_instansi as nama, i.alamat_instansi as alamat,  COUNT(DISTINCT u.id_user) AS jumlah 
												FROM instansi i 
												LEFT  JOIN user u ON i.id_instansi = u.id_instansi 
												GROUP BY i.id_instansi, i.nama_instansi, i.alamat_instansi";

												
												$result = mysqli_query($koneksi, $query);
												
												if (!$result) {
												die("Error: " . mysqli_error($koneksi));
												}
												
												if (mysqli_num_rows($result) > 0) {
												$no = 1;
												while ($row = mysqli_fetch_assoc($result)) {
												echo "<tr>";
												echo "<td>" . $no++ . "</td>";
												echo "<td>" . $row['nama'] . "</td>";
												echo "<td>" . $row['alamat'] . "</td>";
												echo "<td class='d-inline-flex'><button class='btn btn-success btn-sm mr-2' onclick='showModal(\"{$row['nama']}\")'>Detail</button>";
												echo "<a href='edit-instansi.php?id=" . $row['id_ins'] ."' class='bg-primary btn btn-sm text-white mr-2 editBtn' data-id='" . $row['id_ins'] . "'><i class='fas fa-pencil-alt'></i></a>";
												echo "<a href='#' class='bg-danger btn btn-sm text-white deleteBtn' data-id='" . $row['id_ins'] . "'><i class='fas fa-trash'></i></a>";
												echo "</tr>";
												}
												} else {
												echo "<tr><td colspan='4'>Tidak ada data instansi yang ditemukan</td></tr>";
												}
												
												mysqli_close($koneksi);
												?>
										</tbody>
										<tfoot>
											<tr>
												<th>-</th>
												<th>Instansi</th>
												<th>Alamat</th>
												<th>-</th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
						<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-scrollable" role="document"> 
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

						<script>
							function showModal(asal) {
							    $.ajax({
							        url: 'ajax-get-pemagang.php',
							        method: 'POST',
							        data: {
							            asal: asal
							        },
							        success: function(response) {
							            document.querySelector('#ttl').innerText = asal;
							            var modalBody = document.getElementById('userModalBody');
							            modalBody.innerHTML = response;
							
							            $('#userModal').modal('show');
							        },
							        error: function(xhr, status, error) {
							            console.error(xhr.responseText);
							        }
							    });
							}
						</script>
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
		<script>
			document.addEventListener('DOMContentLoaded', function() {
			    const editButtons = document.querySelectorAll('.editBtn');
			    editButtons.forEach(button => {
			        button.addEventListener('click', function() {
			            const id = this.getAttribute('data-id');
			                    window.location.href = 'edit-presensi.php?id=' + id;
			        });
			    });
			
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
			                    window.location.href = 'handler/handler-delete-instansi.php?id=' + id;
			                }
			            });
			        });
			    });
			});
		</script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
		<script src="../js/sb-admin-2.min.js"></script>
		<script>
			$(document).ready(function() {
			$('#dataTable').DataTable({
				order : [1, "asc"],
			initComplete: function () {
			this.api().columns().every( function () {
			var column = this;
			var select;
			
			if (column.index() == 1) {
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
			} else if (column.index() == 2) {
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