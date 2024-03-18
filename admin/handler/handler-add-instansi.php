<?php
session_start();
require_once "../../koneksi.php";
if (!isset($_SESSION["isLogin"]) || $_SESSION["isLogin"] === false) {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST["nama_instansi"], $_POST["alamat_instansi"])) {
    $nama_instansi = $_POST["nama_instansi"];
    $alamat_instansi = $_POST["alamat_instansi"];

    $query = "INSERT INTO instansi (nama_instansi, alamat_instansi) 
              VALUES ('$nama_instansi', '$alamat_instansi')";

    if (mysqli_query($koneksi, $query)) {
        $_SESSION["success_message_admin"] =
            "Instansi berhasil ditambahkan ke master!";
    } else {
        $_SESSION["error_message_admin"] = "Instansi gagal ditambahkan ke master!";
    }
} else {
    $_SESSION["error_message_admin"] = "Instansi gagal ditambahkan ke master!";
}

header("Location: " . $_SERVER["HTTP_REFERER"]);
mysqli_close($koneksi);
?>
