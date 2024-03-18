<?php
session_start();

// Hapus session login_user jika ada
if (isset($_SESSION['login_user'])) {
    unset($_SESSION['login_user']);
}

// Redirect ke halaman login
header("Location: index.php");
exit(); 
?>
