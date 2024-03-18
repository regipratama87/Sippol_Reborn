<?php
session_start();
require "../../koneksi.php";

if (!isset($_SESSION["isLogin"]) || $_SESSION["isLogin"] === false) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id_pengajuan = $_GET["id"];

    $query_select_files = "SELECT srt_pengajuan, srt_balasan FROM pengajuan WHERE id_pengajuan = $id_pengajuan";
    $result_select_files = mysqli_query($koneksi, $query_select_files);

    if ($result_select_files) {
        $row = mysqli_fetch_assoc($result_select_files);

        if (file_exists($row["srt_pengajuan"])) {
            unlink($row["srt_pengajuan"]);
        }

        if (file_exists($row["srt_balasan"])) {
            unlink($row["srt_balasan"]);
        }

        $query_delete_pengajuan = "DELETE FROM pengajuan WHERE id_pengajuan = $id_pengajuan";
        $result_delete_pengajuan = mysqli_query(
            $koneksi,
            $query_delete_pengajuan
        );

        if ($result_delete_pengajuan) {
            $_SESSION["success_message_admin"] = "Data pengajuan berhasil dihapus.";
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        } else {
            $_SESSION["error_message_admin"] =
                "Gagal menghapus data pengajuan: " . mysqli_error($koneksi);
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        }
    } else {
        $_SESSION["error_message_admin"] =
            "Gagal menghapus data pengajuan: " . mysqli_error($koneksi);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
}

mysqli_close($koneksi);
?>
