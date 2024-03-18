<?php
session_start();
require_once "../../koneksi.php";

if (!isset($_SESSION["isLogin"]) || $_SESSION["isLogin"] === false) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = mysqli_real_escape_string($koneksi, $_GET["id"]);

    $query = "DELETE FROM user WHERE id_user = '$id'";

    if (mysqli_query($koneksi, $query)) {
        $_SESSION["success_message_admin"] = "Akun pemagang berhasil dihapus!";
    } else {
        $_SESSION["error_message_admin"] =
            "Gagal menghapus akun pemagang: " . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
} else {
    $_SESSION["warning_message"] =
        "Tidak ada akun pemagang yang dipilih untuk dihapus.";

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}
?>
