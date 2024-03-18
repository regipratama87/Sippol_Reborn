<?php
session_start();
require "../../koneksi.php";
if (!isset($_SESSION["isLogin"]) || $_SESSION["isLogin"] === false) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_POST["id_user"];
    $username = $_POST["username"];
    $nama = $_POST["nama"];
    $npm = $_POST["npm"];
    $asal = $_POST["asal"];
    $mulai_magang = $_POST["mulai_magang"];
    $akhir_magang = $_POST["akhir_magang"];
    $status = $_POST["status"];

    // Cek apakah password diisi
    if (!empty($_POST["password"])) {
        // Hash the password
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $password_sql = "password = '$password',";
    } else {
        $password_sql = ""; // Jika password kosong, tidak melakukan update pada password
    }

    $query_instansi = "SELECT id_instansi FROM instansi WHERE nama_instansi = '$asal'";
    $result_instansi = $koneksi->query($query_instansi);

    if ($result_instansi) {
        if ($result_instansi->num_rows == 1) {
            $row_instansi = $result_instansi->fetch_assoc();
            $id_instansi = $row_instansi["id_instansi"];
            $sql = "UPDATE user 
                    SET username = '$username', 
                        nama = '$nama', 
                        npm = '$npm', 
                        $password_sql
                        id_instansi = '$id_instansi', 
                        mulai_magang = '$mulai_magang', 
                        akhir_magang = '$akhir_magang', 
                        status = '$status' 
                    WHERE id_user = '$id_user'";

            if ($koneksi->query($sql) === true) {
                $_SESSION["success_message_admin"] =
                    "Informasi pemagang berhasil diperbarui.";
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit();
            } else {
                $_SESSION["error_message_admin"] = "Error: " . $koneksi->error;
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit();
            }
        }
    }

    $koneksi->close();
}
?>
