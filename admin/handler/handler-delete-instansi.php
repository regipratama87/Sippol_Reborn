<?php
session_start();
require_once "../../koneksi.php";

if (!isset($_SESSION["isLogin"]) || $_SESSION["isLogin"] === false) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "DELETE FROM instansi WHERE id_instansi = '$id'";

    if (mysqli_query($koneksi, $query)) {
        $_SESSION["success_message_admin"] = "Instansi berhasil dihapus.";
    } else {
        $_SESSION["error_message_admin"] =
            "Gagal menghapus instansi: " . mysqli_error($koneksi);
    }
} else {
    $_SESSION["error_message_admin"] = "ID instansi tidak valid.";
}

mysqli_close($koneksi);
header("Location: " . $_SERVER["HTTP_REFERER"]);
exit();
?>
