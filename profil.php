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

date_default_timezone_set('Asia/Jakarta'); 
$now = date('Y-m-d H:i:s');
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
    <title>Profil -
            <?php echo $title ?>
        </title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
</head>

<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <div class="my-5 bg-white rounded  border p-4">
                <h2 class="h3 mb-3 text-gray-800 font-weight-bold">Ubah Profil</h2>
                <?php include('template-alert.php')?>
                <form method="POST" action="handler-edit-profil.php">
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input class="form-control" type="text" id="nama" name="nama" required value="<?php echo $nama; ?>">
                    </div>
                    <div class="form-group">
                        <label for="npm">NPM:</label>
                        <input class="form-control" type="text" id="npm" name="npm" readonly value="<?php echo $npm; ?>">
                    </div>
                    <div class="form-group">
                        <label for="asal">Instansi:</label>
                        <input class="form-control" type="text" id="id_instansi" value="<?php echo $nama_instansi; ?>" name="id_instansi" readonly>
                    </div>
                    <div class="form-group">
                        <label for="password">Password Baru:</label>
                        <input class="form-control" type="password" id="password" name="password" placeholder="Isi jika ingin mengubah password...">
                    </div>
                    <div class="form-group">
                        <label for="konfirmasi_password">Konfirmasi Password Baru:</label>
                        <input class="form-control" type="password" id="konfirmasi_password" name="konfirmasi_password" placeholder="Harap isi konfirmasi password..">
                    </div>
                    <input type="submit" class="btn btn-sm bg-primary shadow text-white" value="Simpan Perubahan">
                    <a href="index.php" class="btn btn-sm btn-danger shadow-sm" >Kembali</a>
                </form>
                </div>
            </div>
                        </div>

            <footer class="sticky-footer bg-white border-top">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <?php
                            require('koneksi.php');
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

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

</body>
</html>
