<?php
session_start();
require('../../koneksi.php');
if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] === false) {
    header("Location: ../login.php");
    exit(); 
}

$selected_year = $_POST['selected_year'];
$selected_month = $_POST['selected_month'];
$selected_date = $_POST['selected_date'];
$selected_institution = $_POST['selected_institution'];
$query = "SELECT id_data,data_nama,data_npm,data_asal,data_tanggal, data_status, data_deskripsi FROM presensi WHERE ";

if (!empty($selected_year)) {
    $query .= "YEAR(data_tanggal) = '$selected_year' AND ";
}else {
    $query .= "1 = 1";
}
if (!empty($selected_month)) {
    $query .= "MONTH(data_tanggal) = '$selected_month' AND ";
}
if (!empty($selected_date)) {
    $query .= "DAY(data_tanggal) = '$selected_date' AND ";
}
if (!empty($selected_institution)) {
    $query .= "data_asal = '$selected_institution' AND ";
}

$query = rtrim($query, 'AND ');
$result = $koneksi->query($query);
$data = array();

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$response = array(
    'success' => true,
    'data' => $data
);

echo json_encode($response);

$koneksi->close();
?>
