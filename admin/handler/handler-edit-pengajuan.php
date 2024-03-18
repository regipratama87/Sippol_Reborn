<?php
session_start();
require '../../koneksi.php';

if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] === false) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pengajuan = $_POST['id_pengajuan'];
    $id_instansi = $_POST['nama_instansi'];
    $tahun = $_POST['tahun'];
    $keterangan = $_POST['keterangan'];

    $srt_pengajuan_files = $_FILES['srt_pengajuan'];
    $srt_balasan_files = $_FILES['srt_balasan'];

    $max_file_size = 2 * 1024 * 1024;
    $target_pengajuan_dir = "../files/pengajuan/";
    $target_balasan_dir = "../files/balasan/";

    $query = "UPDATE pengajuan SET ";

    $query .= "id_instansi = '$id_instansi', ";
    $query .= "tahun = '$tahun', ";
    $query .= "keterangan = '$keterangan', ";

    // Hapus file fisik lama jika ada
    $query_select_files = "SELECT srt_pengajuan, srt_balasan FROM pengajuan WHERE id_pengajuan = $id_pengajuan";
    $result_select_files = mysqli_query($koneksi, $query_select_files);
    $row_select_files = mysqli_fetch_assoc($result_select_files);

    $delete_old_files = false;

    if (!empty($srt_pengajuan_files['name']) && !empty($srt_balasan_files['name'])) {
        if ($srt_pengajuan_files['name'] === $srt_balasan_files['name']) {
            $_SESSION['error_message_admin'] = "Nama file Surat Pengajuan dan Surat Balasan tidak boleh sama.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        if ($srt_pengajuan_files['name'] === $row_select_files['srt_balasan'] && $srt_balasan_files['name'] === $row_select_files['srt_pengajuan']) {
            $_SESSION['error_message_admin'] = "Nama file Surat Pengajuan dan Surat Balasan tidak boleh sama.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    if (!empty($srt_pengajuan_files['name'])) {
        $srt_pengajuan_file = $target_pengajuan_dir . basename($srt_pengajuan_files['name']);
        $file_type_pengajuan = strtolower(pathinfo($srt_pengajuan_file, PATHINFO_EXTENSION));
        if ($file_type_pengajuan !== 'pdf') {
            $_SESSION['error_message_admin'] = "File surat pengajuan harus dalam format PDF.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        if ($srt_pengajuan_files['size'] > $max_file_size) {
            $_SESSION['error_message_admin'] = "Ukuran file surat pengajuan melebihi batas maksimum (2MB).";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        if (!move_uploaded_file($srt_pengajuan_files['tmp_name'], $srt_pengajuan_file)) {
            $_SESSION['error_message_admin'] = "Gagal mengunggah file surat pengajuan.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        if (!empty($row_select_files['srt_pengajuan']) && $srt_pengajuan_files['name'] != $row_select_files['srt_pengajuan']) {
            unlink($row_select_files['srt_pengajuan']);
            $delete_old_files = true;
        }
        $query .= "srt_pengajuan = '$srt_pengajuan_file', ";
    }

    if (!empty($srt_balasan_files['name'])) {
        $srt_balasan_file = $target_balasan_dir . basename($srt_balasan_files['name']);
        $file_type_balasan = strtolower(pathinfo($srt_balasan_file, PATHINFO_EXTENSION));
        if ($file_type_balasan !== 'pdf') {
            $_SESSION['error_message_admin'] = "File surat balasan harus dalam format PDF.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        if ($srt_balasan_files['size'] > $max_file_size) {
            $_SESSION['error_message_admin'] = "Ukuran file surat balasan melebihi batas maksimum (2MB).";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        if (!move_uploaded_file($srt_balasan_files['tmp_name'], $srt_balasan_file)) {
            $_SESSION['error_message_admin'] = "Gagal mengunggah file surat balasan.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
        if (!empty($row_select_files['srt_balasan']) && $srt_balasan_files['name'] != $row_select_files['srt_balasan']) {
            unlink($row_select_files['srt_balasan']);
            $delete_old_files = true;
        }
        $query .= "srt_balasan = '$srt_balasan_file', ";
    }

    $query = rtrim($query, ", ");
    $query .= " WHERE id_pengajuan = $id_pengajuan";

    if (mysqli_query($koneksi, $query)) {
        if ($delete_old_files) {
            $_SESSION['success_message_admin'] = "Data pengajuan berhasil diperbarui.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $_SESSION['success_message_admin'] = "Data pengajuan berhasil diperbarui.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    } else {
        // Jika pembaruan gagal, tidak lakukan apa pun dengan file
        $_SESSION['error_message_admin'] = "Gagal memperbarui data pengajuan.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    mysqli_close($koneksi);
}
?>
