<?php
session_start();
require('../../koneksi.php');

if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] === false) {
    header("Location: ../login.php");
    exit(); 
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM presensi WHERE id_data = $id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $_SESSION['success_message_admin'] = "Data presensi berhasil dihapus.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        $_SESSION['error_message_admin'] = "Gagal menghapus data presensi: " . mysqli_error($koneksi);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    $_SESSION['error_message_admin'] = "ID data tidak ditemukan.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

mysqli_close($koneksi);
?>
