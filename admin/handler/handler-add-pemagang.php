<?php
session_start();
require_once "../../koneksi.php";

if (!isset($_SESSION["isLogin"]) || $_SESSION["isLogin"] === false) {
    header("Location: ../login.php");
    exit();
}

$username = $_POST["username"];
$password = $_POST["password"];
$nama = $_POST["nama"];
$npm = $_POST["npm"];
$asal = $_POST["asal"];
$mulai_magang = $_POST["mulai_magang"];
$akhir_magang = $_POST["akhir_magang"];
$status = $_POST["status"];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO user (username, nama, npm, password, id_instansi, mulai_magang, akhir_magang, status) 
          VALUES ('$username', '$nama','$npm', '$hashed_password', (SELECT id_instansi FROM instansi WHERE nama_instansi = '$asal'), '$mulai_magang', '$akhir_magang', $status)";

if (mysqli_query($koneksi, $query)) {
    $_SESSION["success_message_admin"] = "Akun pemagang berhasil ditambahkan!";
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
} else {
    $_SESSION["error_message_admin"] = "Akun pemagang gagal ditambahkan!";
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}

mysqli_close($koneksi);
?>
