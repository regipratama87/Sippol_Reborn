<?php
require('koneksi.php');
session_start();
$username = $_SESSION['login_user'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_baru = $_POST['nama'];
    // $npm_baru = $_POST['npm'];
    // $id_instansi_baru = $_POST['id_instansi'];

    $update_query = "UPDATE user 
                     SET nama = '$nama_baru'
                     WHERE username = '$username'";
    $update_result = mysqli_query($koneksi, $update_query);

    if ($update_result) {
        header("Location: profil.php");
        $_SESSION['success_message'] = "Profil berhasil di update.";
        exit();
    } else {
        $_SESSION['error_message'] = "Gagal mengupdate profil. Silakan coba lagi.";
    }
}

?>