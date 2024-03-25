<?php
require('koneksi.php');
session_start();
$username = $_SESSION['login_user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_baru = $_POST['nama'];
    $password_baru = $_POST['password']; // tambahkan baris ini untuk mendapatkan nilai password baru
    $konfirmasi_password = $_POST['konfirmasi_password']; // tambahkan baris ini untuk mendapatkan nilai konfirmasi password

    // Update nama
    $update_query = "UPDATE user 
                     SET nama = '$nama_baru'
                     WHERE username = '$username'";
    $update_result = mysqli_query($koneksi, $update_query);

    // Update password hanya jika password baru dan konfirmasi password diisi dan sesuai
    if (!empty($password_baru) && $password_baru === $konfirmasi_password) {
        $hashed_password = password_hash($password_baru, PASSWORD_DEFAULT); // hash password baru sebelum disimpan

        $update_password_query = "UPDATE user 
                                  SET password = '$hashed_password' 
                                  WHERE username = '$username'";
        $update_password_result = mysqli_query($koneksi, $update_password_query);

        if ($update_password_result) {
            $_SESSION['success_message'] = "Profil dan password berhasil diupdate.";
            header("Location: profil.php");
        } else {
            $_SESSION['error_message'] = "Gagal mengupdate password. Silakan coba lagi.";
            header("Location: profil.php");
        }
    } elseif (!empty($password_baru) && $password_baru !== $konfirmasi_password) {
        $_SESSION['error_message'] = "Konfirmasi password tidak sesuai.";
        header("Location: profil.php");
    }

    if ($update_result && empty($_SESSION['error_message'])) {
        $_SESSION['success_message'] = "Profil berhasil di update.";
        header("Location: profil.php");
        exit();
    } else {
        // $_SESSION['error_message'] = "Gagal mengupdate profil. Silakan coba lagi.";
        header("Location: profil.php");
    }
}
?>
