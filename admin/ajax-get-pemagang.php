<?php
require('../koneksi.php');

if(isset($_POST['asal'])) {
    $asal = $_POST['asal'];

    // Menampilkan daftar mahasiswa
    $query_mahasiswa = "SELECT u.npm, u.nama, u.mulai_magang
              FROM user u 
              INNER JOIN instansi i ON u.id_instansi = i.id_instansi
              WHERE i.nama_instansi = '$asal'
              ORDER BY YEAR(u.mulai_magang) DESC, MONTH(u.mulai_magang) DESC"; 
    $result_mahasiswa = mysqli_query($koneksi, $query_mahasiswa);

    $data = array(); 
    $currentMonthYear = null;

    if(mysqli_num_rows($result_mahasiswa) > 0) {
        while ($row = mysqli_fetch_assoc($result_mahasiswa)) {
            $monthYear = date('F Y', strtotime($row['mulai_magang'])); 
            if ($monthYear != $currentMonthYear) {
                if ($currentMonthYear !== null) {
                    $data[] = ''; 
                }
                $data[] = $monthYear .' : ';
                $currentMonthYear = $monthYear;
            }
            $data[] = '- '.$row['nama'] . ' (' . $row['npm'] . ')'; 
        }
        echo implode('<br>', $data); 
    } else {
        echo "Data mahasiswa tidak ditemukan";
    }

    // Menampilkan tabel jumlah pemagang berdasarkan tahun
    $query_jumlah_pemagang = "SELECT YEAR(u.mulai_magang) AS tahun, COUNT(*) AS jumlah_pemagang
              FROM user u 
              INNER JOIN instansi i ON u.id_instansi = i.id_instansi
              WHERE i.nama_instansi = '$asal'
              GROUP BY YEAR(u.mulai_magang)
              ORDER BY YEAR(u.mulai_magang) DESC"; 
    $result_jumlah_pemagang = mysqli_query($koneksi, $query_jumlah_pemagang);

    if(mysqli_num_rows($result_jumlah_pemagang) > 0) {
        echo '<table class="table mt-3 border rounded">';
        echo '<thead><tr><th>Tahun</th><th>Jumlah Pemagang</th></tr></thead>';
        echo '<tbody>';
        while ($row = mysqli_fetch_assoc($result_jumlah_pemagang)) {
            echo '<tr>';
            echo '<td>' . $row['tahun'] . '</td>';
            echo '<td>' . $row['jumlah_pemagang'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo "Data jumlah pemagang tidak ditemukan";
    }
} else {
    echo "Permintaan tidak valid";
}

mysqli_close($koneksi);
?>
