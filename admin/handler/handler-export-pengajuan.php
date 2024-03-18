<?php
require('../../koneksi.php');

// URL dasar proyek Anda
$base_url = "http://localhost/Diskominfo/admin/";

// Query untuk mendapatkan data pengajuan
$query = "SELECT p.*, i.nama_instansi
            FROM pengajuan p
            LEFT JOIN instansi i ON p.id_instansi = i.id_instansi";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Error: " . mysqli_error($koneksi));
}

if (mysqli_num_rows($result) > 0) {
    // Set header untuk file CSV
    header('Content-Type: text/csv');
    $filename = 'export_pengajuan_' . date('Ymd') . '.csv';
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Buka file output
    $file = fopen('php://output', 'w');

    // Judul Laporan
    $title = "Laporan Surat Pengajuan";
    fputcsv($file, array($title));
    fputcsv($file, array('')); // Baris kosong

    // Header kolom
    $header = array(
        "No",
        "Instansi",
        "Pengajuan",
        "Balasan",
        "Tahun",
        "Keterangan",
        "Tanggal"
    );
    fputcsv($file, $header);

    // Iterasi hasil query dan tulis ke file CSV
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        // Ubah path file PDF menjadi URL lengkap
        $pengajuan_file = $base_url . 'files/pengajuan/' . basename($row['srt_pengajuan']);
        $balasan_file = $base_url . 'files/pengajuan/' . basename($row['srt_balasan']);
        
        $data = array(
            $no++,
            $row['nama_instansi'],
            '=HYPERLINK("' . $pengajuan_file . '", "Buka Berkas")',
            '=HYPERLINK("' . $balasan_file . '", "Buka Berkas")',
            $row['tahun'],
            $row['keterangan'],
            $row['timestamp']
        );
        fputcsv($file, $data);
    }

    // Tutup file
    fclose($file);
    exit;
} else {
    echo "Tidak ada data yang ditemukan untuk diekspor.";
}

mysqli_close($koneksi);
?>
