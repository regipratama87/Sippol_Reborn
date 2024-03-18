<?php
session_start();

// Hapus session login_user jika ada
if (isset($_SESSION['isLogin'])) {
    unset($_SESSION['isLogin']);
}

// Redirect ke halaman login
header("Location: index.php");
exit(); 
?>
