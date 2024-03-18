<?php
require('../koneksi.php');
$id_user = $_GET['id_user'];
$sql = "SELECT user.nama, user.npm, instansi.nama_instansi 
        FROM user 
        INNER JOIN instansi ON user.id_instansi = instansi.id_instansi 
        WHERE user.id_user = $id_user";

$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data['nama'] = $row['nama'];
        $data['npm'] = $row['npm'];
        $data['nama_instansi'] = $row['nama_instansi'];
    }
    echo json_encode($data);
} else {
    echo json_encode(array("nama" => "-", "npm" => "-", "nama_instansi" => "-"));
}
$koneksi->close();
?>