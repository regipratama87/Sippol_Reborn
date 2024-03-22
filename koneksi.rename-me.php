<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "sippol_reborn_kedirikab";

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error(). "</br></br><hr><b>Error!</b> Harap ubah isi koneksi.php, sesuaikan dengan database anda.</hr>");
}
?>
