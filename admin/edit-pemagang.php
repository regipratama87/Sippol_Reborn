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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit Pemagang - <?php echo $title ?></title>
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
                    
                    $id_user = $username = $nama = $asal = $mulai_magang = $akhir_magang = $status = $npm = '';
                    
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
                            $npm = $row['npm'];
                            // Tidak menampilkan password yang di-hash
                            $password_placeholder = "********"; // Placeholder untuk password
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
                    <div class="my-3 bg-white rounded border p-4">
                        <h2 class="h3 mb-3 text-gray-800 font-weight-bold">Edit Informasi Pemagang</h2>
                        <?php include('template-alert.php')?>
                        <form method="post" action="handler/handler-edit-pemagang.php?id=user=<?php echo $id_user; ?>" >
                            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                            <div class="form-group">
                                <label>Username:</label>
                                <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
                            </div>
                            <div class="form-group">
                                <label>Password:</label>
                                <input class="form-control" type="password" name="password" placeholder="Isi untuk mengubah password">
                            </div>
                            <div class="form-group">
                                <label>Nama:</label>
                                <input class="form-control" type="text" name="nama" value="<?php echo $nama; ?>">
                            </div>
                            <div class="form-group">
                                <label>NPM:</label>
                                <input class="form-control" type="number" name="npm" value="<?php echo $npm; ?>">
                            </div>
                            <div class="form-group">
                                <label>Asal:</label>
                                <select class="form-control" name="asal">
                                <?php
                                $sql_instansi = "SELECT nama_instansi FROM instansi";
                                $result_instansi = $koneksi->query($sql_instansi);
                                
                                if ($result_instansi) {
                                    if ($result_instansi->num_rows > 0) {
                                        while ($row_instansi = $result_instansi->fetch_assoc()) {
                                            $selected = ($row_instansi['nama_instansi'] == $asal) ? 'selected' : '';
                                            echo "<option value='" . $row_instansi['nama_instansi'] . "' $selected>" . $row_instansi['nama_instansi'] . "</option>";
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
                            <div class="form-group">
                                <label>Mulai Magang:</label>
                                <input class="form-control" type="datetime-local"name="mulai_magang" value="<?php echo $mulai_magang; ?>">
                            </div>
                            <div class="form-group">
                                <label>Akhir Magang:</label>
                                <input class="form-control" type="datetime-local"name="akhir_magang" value="<?php echo $akhir_magang; ?>">
                            </div>
                            <div class="form-group">
                                <label>Status:</label><br>
                                <label class="radio-inline">
                                <input type="radio" name="status" value="1" <?php if ($status == 1) echo "checked"; ?>> Enabled
                                </label>
                                <label class="radio-inline ml-3">
                                <input type="radio" name="status" value="0" <?php if ($status == 0) echo "checked"; ?>> Disabled
                                </label>
                            </div>
                            <div>
                                <input class="btn btn-sm btn-primary shadow-sm" type="submit" value="Update">
                                <a href="data-pemagang.php" class="btn btn-sm btn-danger shadow-sm" >Kembali</a>
                            </div>
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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
</body>
</html>
