<?php
    session_start();
    require('koneksi.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = $_POST['data_nama'];
        $npm = $_POST['data_npm'];
        $asal = $_POST['data_asal'];
        $status = $_POST['data_status'];
        $deskripsi = $_POST['data_deskripsi'];
        $id_user = $_SESSION['id_user']; 
        $nama = mysqli_real_escape_string($koneksi, $nama);
        $npm = mysqli_real_escape_string($koneksi, $npm);
        $asal = mysqli_real_escape_string($koneksi, $asal);
        $status = mysqli_real_escape_string($koneksi, $status);
        $deskripsi = mysqli_real_escape_string($koneksi, $deskripsi);
        date_default_timezone_set('Asia/Jakarta'); 
        $data_tanggal = date("Y-m-d H:i:s");
        $query = "INSERT INTO presensi (data_nama, data_npm, data_asal, data_status, data_deskripsi, data_tanggal, id_user) 
                  VALUES ('$nama', '$npm', '$asal', '$status', '$deskripsi', '$data_tanggal', '$id_user')";

        if (mysqli_query($koneksi, $query)) {
            $_SESSION['success_message'] = "Absensi berhasil disimpan.";
            header("location: index.php");
        } else {
            $_SESSION['error_message'] = "Terjadi kesalahan. Data tidak berhasil disimpan.";
            header("location: index.php");
        }
    } else {
        header("location: index.php");
    }
?>
