<?php
session_start();
require_once '../../koneksi.php';
if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] === false) {
    header("Location: ../login.php");
    exit(); 
}

$selected_month = isset($_POST['selected_month']) ? $_POST['selected_month'] : '';
$selected_year = isset($_POST['selected_year']) ? $_POST['selected_year'] : '';
$selected_date = isset($_POST['selected_date']) ? $_POST['selected_date'] : '';
$selected_institution = isset($_POST['selected_institution']) ? $_POST['selected_institution'] : '';

$filter_info = array(
    'Instansi' => $selected_institution,
    'Bulan' => $selected_month,
    'Tahun' => $selected_year
);

$sql = "SELECT * FROM presensi WHERE 1 = 1";

if (!empty($selected_month)) {
    $sql .= " AND MONTH(data_tanggal) = $selected_month";
}
if (!empty($selected_year)) {
    $sql .= " AND YEAR(data_tanggal) = $selected_year";
}
if (!empty($selected_date)) {
    $sql .= " AND DAY(data_tanggal) = $selected_date";
}
if (!empty($selected_institution)) {
    $selected_institution = mysqli_real_escape_string($koneksi, $selected_institution);
    $sql .= " AND data_asal = '$selected_institution'";
}

$result = $koneksi->query($sql);

if ($result && $result->num_rows > 0) {
    header('Content-Type: text/csv');
    $filename = 'export-' . date('d-F-Y') . '.csv';
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $file = fopen('php://output', 'w');

    $title = "Laporan Presensi Pemagang $selected_year";
    fputcsv($file, array($title));
    foreach ($filter_info as $filter_name => $filter_value) {
        fputcsv($file, array("Filter $filter_name:", $filter_value));
    }
    fputcsv($file, array(''));
    fputcsv($file, array(''));

    $header = array(
        "No",
        "Nama",
        "NPM",
        "Instansi",
        "Jenis Presensi",
        "Tanggal",
        "Deskripsi"
    );
    fputcsv($file, $header);

    $counter = 1;
    while ($row = $result->fetch_assoc()) {
        $jenis_presensi = '';
        if ($row['data_status'] == 5) {
            $jenis_presensi = 'Presensi Masuk';
        } elseif ($row['data_status'] == 6) {
            $jenis_presensi = 'Presensi Keluar';
        }
    
        // Ubah format tanggal
        $date_obj = DateTime::createFromFormat('Y-m-d H:i:s', $row['data_tanggal']);
        $formatted_date = $date_obj->format(' F d Y H:i:s');
    
        $data = array(
            $counter++,
            $row['data_nama'],
            str_pad($row['data_npm'], 50, " "),
            $row['data_asal'],
            $jenis_presensi,
            $formatted_date, // Gunakan format tanggal yang baru
            str_pad($row['data_deskripsi'], 50, " ")
        );
        fputcsv($file, $data);
    }
    

    fclose($file);
    exit;
} else {
    $_SESSION["error_message_admin"] = "Tidak ada data yang bisa di export.";
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}

$koneksi->close();
?>
