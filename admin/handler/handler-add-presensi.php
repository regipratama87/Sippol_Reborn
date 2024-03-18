<?php
session_start();
require "../../koneksi.php";
if (!isset($_SESSION["isLogin"]) || $_SESSION["isLogin"] === false) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST["id_user"];
    $data_nama = $_POST["data_nama"];
    $data_npm = $_POST["data_npm"];
    $data_tanggal = $_POST["data_tanggal"];
    $data_status = $_POST["data_status"];
    $data_deskripsi = $_POST["data_deskripsi"];
    $data_asal = $_POST["data_asal"];

    $sql_presensi = "INSERT INTO presensi (id_user, data_nama, data_npm, data_tanggal, data_status, data_deskripsi, data_asal) 
                VALUES ('$id_user', '$data_nama', '$data_npm', '$data_tanggal', '$data_status', '$data_deskripsi', '$data_asal')";

    if ($koneksi->query($sql_presensi) === true) {
        $_SESSION["success_message_admin"] = "Presensi berhasil ditambahkan!";
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    } else {
        $_SESSION["error_message_admin"] = "Presensi gagal ditambahkan!!";
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
    $koneksi->close();
} else {
    $_SESSION["error_message_admin"] = "Presensi gagal ditambahkan!!";
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}
?>
