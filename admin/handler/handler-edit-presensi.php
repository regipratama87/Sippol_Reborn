<?php
session_start();
require('../../koneksi.php');

if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] === false) {
    header("Location: ../login.php");
    exit(); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $data_nama = $_POST['data_nama'];
        $data_npm = $_POST['data_npm'];
        $data_asal = $_POST['data_asal'];
        $data_tanggal = $_POST['data_tanggal'];
        $data_status = $_POST['data_status'];
        $data_deskripsi = $_POST['data_deskripsi'];

        $query = "UPDATE presensi SET 
                    data_nama = '$data_nama',
                    data_npm = '$data_npm',
                    data_asal = '$data_asal',
                    data_tanggal = '$data_tanggal',
                    data_status = '$data_status',
                    data_deskripsi = '$data_deskripsi'
                    WHERE id_data = $id";

        $result = mysqli_query($koneksi, $query);

        if ($result) {
            $_SESSION['success_message_admin'] = "Data presensi berhasil diupdate.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['error_message_admin'] = "Gagal melakukan update data.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } else {
        $_SESSION['error_message_admin'] = "ID data tidak ditemukan.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
?>
