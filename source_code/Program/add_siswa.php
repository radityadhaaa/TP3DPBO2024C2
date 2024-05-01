<?php

include('classes/Template.php');
include('config/db.php');
include('classes/DB.php');
include('classes/Jurusan.php');
include('classes/Kelas.php');
include('classes/Siswa.php');

$siswa = new Siswa($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$dataJurusan = new Jurusan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$dataKelas = new Kelas($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$siswa->open();
$dataJurusan->open();
$dataKelas->open();
$dataJurusan->getJurusan();
$dataKelas->getKelas();


$Data_jurusan = null;
$Data_kelas = null;
$Data_nama = null;
$Data_upload = null;
$Data_nama_siswa = '';
$Data_id_jurusan = 1;
$Data_id_kelas = 1;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        // Jika ada ID, ambil data siswa yang akan diperbarui
        $siswa->getSiswaById($id);
        $row = $siswa->getResult();

        // Isi form dengan data yang ada
        $Data_nama_siswa = $row['nama_siswa'];
        $Data_id_jurusan = $row['id_jurusan'];
        $Data_id_kelas = $row['id_kelas'];
        $Data_upload .= 'add_siswa.php?id='.$row['id_siswa'].'';
    }
}else{
    $Data_upload .= 'add_siswa.php';
}

while ($row = $dataJurusan->getResult()) {
    $selected = ($row['id_jurusan'] == $Data_id_jurusan) ? 'selected' : ''; 
    $Data_jurusan .= '<option value="' . $row['id_jurusan'] . '" ' . $selected . '>' . $row['nama_jurusan'] . '</option>';
}

while ($row = $dataKelas->getResult()) {
    $selected = ($row['id_kelas'] == $Data_id_kelas) ? 'selected' : ''; 
    $Data_kelas .= '<option value="' . $row['id_kelas'] . '" ' . $selected . '>' . $row['nama_kelas'] . '</option>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data dari form
    $nama_siswa = $_POST['nama_siswa'];
    $id_jurusan = $_POST['id_jurusan'];
    $id_kelas = $_POST['id_kelas'];

    $data = [
        'nama_siswa' => $nama_siswa,
        'id_jurusan' => $id_jurusan,
        'id_kelas' => $id_kelas
    ];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if ($id > 0) {
            $siswa->updateData($id, $data);
        }
    }else{
        $siswa->addData($data);
    }
    header("Location: index.php");
    exit;

}


$siswa->close();
$dataJurusan->close();
$dataKelas->close();
$detail = new Template('templates/addSiswa.html');
$detail->replace('ADD_DATA_JURUSAN', $Data_jurusan);
$detail->replace('ADD_DATA_kELAS', $Data_kelas);
$detail->replace('ADD_DATA_NAMA', $Data_nama_siswa);
$detail->replace('ADD_DATA_UPLOAD', $Data_upload);
$detail->write();
?>
