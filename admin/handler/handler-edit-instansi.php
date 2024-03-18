<?php
session_start();
require_once('../../koneksi.php');

if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] === false) {
    header("Location: ../login.php");
    exit(); 
}

if(isset($_POST['id_instansi'], $_POST['nama_instansi'], $_POST['alamat_instansi'])) {
    $id_instansi = $_POST['id_instansi'];
    $nama_instansi = $_POST['nama_instansi'];
    $alamat_instansi = $_POST['alamat_instansi'];
    $query = "UPDATE instansi SET nama_instansi='$nama_instansi', alamat_instansi='$alamat_instansi' WHERE id_instansi='$id_instansi'";

    if (mysqli_query($koneksi, $query)) {
        $_SESSION['success_message_admin'] = "Data instansi berhasil diperbarui.";
    } else {
        $_SESSION['error_message_admin'] = "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
} else {
    $_SESSION['error_message_admin'] = "Data tidak lengkap.";
}

mysqli_close($koneksi);
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
?>
