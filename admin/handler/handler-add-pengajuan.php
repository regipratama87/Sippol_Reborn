<?php
session_start();
require "../../koneksi.php";

if (!isset($_SESSION["isLogin"]) || $_SESSION["isLogin"] === false) {
    header("Location: ../login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_instansi = $_POST["nama_instansi"];
    $tahun = $_POST["tahun"];
    $keterangan = $_POST["keterangan"];
    $srt_pengajuan_files = $_FILES["srt_pengajuan"];
    $srt_balasan_files = $_FILES["srt_balasan"];
    $maxFileSize = 2 * 1024 * 1024; 
    $allowedExtensions = ["pdf"];
    $query =
        "INSERT INTO pengajuan (id_instansi, srt_pengajuan, srt_balasan, tahun, keterangan) VALUES ";
    for ($i = 0; $i < count($srt_pengajuan_files["name"]); $i++) {
        $target_dir_pengajuan = "../files/pengajuan/";
        $srt_pengajuan_file =
            $target_dir_pengajuan . basename($srt_pengajuan_files["name"][$i]);
        $target_dir_balasan = "../files/balasan/";
        $srt_balasan_file =
            $target_dir_balasan . basename($srt_balasan_files["name"][$i]);
        if (
            $srt_pengajuan_files["size"][$i] > $maxFileSize ||
            $srt_balasan_files["size"][$i] > $maxFileSize
        ) {
            $_SESSION["error_message_admin"] =
                "Ukuran file tidak boleh melebihi 2MB.";
            header("location: " . $_SERVER["HTTP_REFERER"]); 
            exit();
        }
        $srt_pengajuan_extension = pathinfo(
            $srt_pengajuan_files["name"][$i],
            PATHINFO_EXTENSION
        );
        $srt_balasan_extension = pathinfo(
            $srt_balasan_files["name"][$i],
            PATHINFO_EXTENSION
        );
        if (
            !in_array($srt_pengajuan_extension, $allowedExtensions) ||
            !in_array($srt_balasan_extension, $allowedExtensions)
        ) {
            $_SESSION["error_message_admin"] = "File harus berupa PDF.";
            header("location: " . $_SERVER["HTTP_REFERER"]); 
            exit();
        }
        if (
            file_exists($srt_pengajuan_file)
        ) {
            $_SESSION["error_message_admin"] = "Nama file Surat Pengajuan tidak boleh sama.";
            header("location: " . $_SERVER["HTTP_REFERER"]); 
            exit();
        }
        if (
            file_exists($srt_balasan_file)
        ) {
            $_SESSION["error_message_admin"] = "Nama file Surat Balasan tidak boleh sama.";
            header("location: " . $_SERVER["HTTP_REFERER"]); 
            exit();
        }

        $upload_pengajuan = move_uploaded_file(
            $srt_pengajuan_files["tmp_name"][$i],
            $srt_pengajuan_file
        );
        $upload_balasan = move_uploaded_file(
            $srt_balasan_files["tmp_name"][$i],
            $srt_balasan_file
        );

        if ($upload_pengajuan && $upload_balasan) {
            $query .= "('$id_instansi', '$srt_pengajuan_file', '$srt_balasan_file', '{$tahun[$i]}', '{$keterangan[$i]}'),";
        } else {
            $_SESSION["error_message_admin"] = "Gagal mengunggah file. ";
            header("location: " . $_SERVER["HTTP_REFERER"]); 
            exit();
        }
    }

    $query = rtrim($query, ",");

    if (mysqli_query($koneksi, $query)) {
        $_SESSION["success_message_admin"] = "Pengajuan berhasil disimpan.";
        header("location: " . $_SERVER["HTTP_REFERER"]); 
        exit();
    } else {
        $_SESSION["error_message_admin"] =
            "Error: Gagal menyimpan data atau tidak ada file yang diunggah.";
        header("location: " . $_SERVER["HTTP_REFERER"]); 
        exit();
    }
    mysqli_close($koneksi);
}
?>
