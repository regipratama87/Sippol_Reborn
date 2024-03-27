<?php
session_start();
include('nav.php');
require('koneksi.php');
$username = $_SESSION['login_user'];
$sql = "SELECT status FROM user WHERE username = '$username'";
$result = $koneksi->query($sql);

// Jika query berhasil dieksekusi
if ($result) {
    $row = $result->fetch_assoc();
    $status = $row['status'];
    
    // Jika status pengguna adalah 0, hapus session login_user
    if ($status == 0) {
        unset($_SESSION['login_user']);
    }
} else {
    // Handle jika terjadi kesalahan pada query
    echo "Error: " . $koneksi->error;
}

if (!isset($_SESSION['login_user'])) {
    header("Location: login.php");
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
    <title>Riwayat Presensi - <?php echo $title ?></title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <div class="my-5 bg-white rounded  border p-4">
                    <h2 class="h3 font-weight-bold text-dark">Riwayat Presensi</h2>
                    <a href="index.php" class="btn btn-sm btn-danger shadow-sm mb-3">Kembali</a>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th data-orderable="false">No</th>
                                <th>Nama</th>
                                <th>NPM</th>
                                <th>Instansi</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['login_user'])) {
    exit("Anda belum login");
}
require_once 'koneksi.php';
$query_data = "SELECT presensi.*, user.nama AS user_nama, user.npm AS user_npm, instansi.nama_instansi AS nama_instansi
               FROM presensi 
               INNER JOIN user ON presensi.id_user = user.id_user 
               INNER JOIN instansi ON user.id_instansi = instansi.id_instansi
               WHERE user.username = '$username'";
$result_data = mysqli_query($koneksi, $query_data);
if (!$result_data || mysqli_num_rows($result_data) === 0) {
}

$no = 1;
while ($row_data = mysqli_fetch_assoc($result_data)) {
    echo '<tr>';
    echo '<td>' .$no. '</td>';
    echo '<td>' . $row_data['user_nama'] . '</td>';
    echo '<td>' . $row_data['user_npm'] . '</td>';
    echo '<td>' . $row_data['nama_instansi'] . '</td>';
    echo '<td>' . $row_data['data_tanggal'] . '</td>';
    if ($row_data['data_status'] == 5) {
        echo '<td><span class="badge bg-success text-white">IN</span></td>';
    } elseif ($row_data['data_status'] == 6) {
        echo '<td><span class="badge bg-danger text-white">OUT</span></td>';
    } else {
        echo '<td>' . $row_data['data_status'] . '</td>';
    }
    echo '<td>' . $row_data['data_deskripsi'] . '</td>';
    echo '</tr>';
    $no++;
}
mysqli_close($koneksi);
?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                </tfoot>
                </table>
                    </div>
                </div>
            </div>
                </div>
                <?php include('footer.php')?>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    
		<script>
			
			$(document).ready(function() {
			$('#dataTable').DataTable({
			initComplete: function () {
			this.api().columns().every( function () {
			var column = this;
			var select;
			
			// if () {
			// select = $('<select><option value=""></option></select>')
			//     .appendTo( $(column.footer()).empty() )
			//     .on( 'change', function () {
			//         var val = $.fn.dataTable.util.escapeRegex(
			//             $(this).val()
			//         );
			
			//         column
			//             .search( val ? '^'+val+'$' : '', true, false )
			//             .draw();
			//     } );
			
			// column.data().unique().sort().each( function ( d, j ) {
			//     select.append( '<option value="'+d+'">'+d+'</option>' )
			// } );

            
			// } 
             if ( column.index() == 4 || column.index() == 5 || column.index() == 6) {
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
