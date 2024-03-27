<html lang="en">
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

$query = "SELECT user.*, instansi.nama_instansi 
          FROM user 
          LEFT JOIN instansi ON user.id_instansi = instansi.id_instansi 
          WHERE username = '$username'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['id_user'] = $row['id_user'];
    $nama = $row['nama'];
    $npm = $row['npm'];
    $instansi = $row['nama_instansi'];
    $nama_instansi = $row['nama_instansi']; 
} else {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Dashboard -
            <?php echo $title ?>
        </title>
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
    </head>

    <body id="page-top">
        <div id="wrapper">
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <div class="container-fluid">
                        <?php
// date_default_timezone_set('Asia/Jakarta');
require('koneksi.php');
$username = $_SESSION['login_user'];
// Pengecekan apakah nama, npm, atau instansi kosong
if (empty($nama) || empty($npm) || empty($instansi)) {
    echo "<div class='container my-5'>
            <div class='alert alert-danger border-0' role='alert'>
                <h4 class='alert-heading font-weight-bold'>Ooops!! data kamu belum lengkap</h4>
                <hr>
                Mohon lengkapi profil anda di <a href='profil.php'>sini</a> sebelum melakukan presensi.
            </div>
          </div>";
} else {
    date_default_timezone_set('Asia/Jakarta');
$username = $_SESSION['login_user'];
$current_date = date('Y-m-d');
$query_presensi = "SELECT COUNT(*) as total_presensi, MAX(data_status) as last_status FROM presensi WHERE id_user = (SELECT id_user FROM user WHERE username = '$username') AND DATE(data_tanggal) = '$current_date'";
$result_presensi = mysqli_query($koneksi, $query_presensi);

    if ($result_presensi) {
        $row_presensi = mysqli_fetch_assoc($result_presensi);
        $total_presensi = $row_presensi['total_presensi'];
        $last_status = $row_presensi['last_status'];
        
        if ($total_presensi < 1) {
            $options = "<option value='5'>Check In</option>";
        } elseif ($total_presensi == 1) {
            // Check status presensi terakhir
            if ($last_status == 5) {
                $options = "<option value='6'>Check Out</option>";
            } else {
                $options = "<option value='5'>Check In</option>";
            }
        } else {
            $options = ""; 
            echo "<div class='container my-5'>
                <div class='alert alert-success border-0' role='alert'>
                    <h4 class='alert-heading font-weight-bold'>Hai, $nama!</h4>
                    <hr>
                    Anda telah melakukan kedua jenis presensi hari ini. Kembali lagi besok!
                </div>
              </div>";
        }

        if ($total_presensi < 2) {
?>
<div class=" my-5 bg-white rounded  border p-4">
            <h2 class="h3 mx-auto font-weight-bold text-dark">Form Presensi</h2>
            <?php include('template-alert.php')?>
            <form action="handler-presensi.php" method="post">
                <div class="mb-3">
                    <label for="data_nama" class="form-label">Nama:</label>
                    <input type="text" class="form-control" id="data_nama" name="data_nama" value="<?php echo $nama; ?>" readonly required>
                </div>
                <div class="mb-3">
                    <label for="data_npm" class="form-label">NPM:</label>
                    <input type="text" class="form-control" id="data_npm" name="data_npm" value="<?php echo $npm; ?>" readonly required>
                </div>
                <div class="mb-3">
                    <label for="data_instansi" class="form-label">Instansi:</label>
                    <input type="text" class="form-control" id="data_instansi" name="data_asal" value="<?php echo $instansi; ?>" readonly required>
                </div>
                <div class="mb-3">
                    <label for="data_status" class="form-label">Status:</label>
                    <select class="form-control" id="data_status" name="data_status" required>
                        <?php echo $options; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="data_deskripsi" class="form-label">Deskripsi:</label>
                    <textarea class="form-control" id="data_deskripsi" name="data_deskripsi" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
</div>
<?php
        }
    } else {
        echo "Kesalahan dalam kueri presensi.";
    }
}
?>

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
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button> <a class="btn btn-primary" href="logout.php">Logout</a> </div>
                </div>
            </div>
        </div>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="js/sb-admin-2.min.js"></script>
    </body>

</html>