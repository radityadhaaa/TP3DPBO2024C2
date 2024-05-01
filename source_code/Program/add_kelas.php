<?php

include('classes/Template.php');
include('config/db.php');
include('classes/DB.php');
include('classes/Kelas.php');



$kelas = new Kelas($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$kelas->open();
$kelas->getKelas();

$Data_nama_kelas = '';
$Data_upload = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $kelas->getKelasById($id);
        $row = $kelas->getResult();

        // Isi form dengan data yang ada
        $Data_nama_kelas = $row['nama_kelas'];
        $Data_upload .= 'add_kelas.php?id='.$row['id_kelas'].'';
    }
}else{
    $Data_upload .= 'add_kelas.php';
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama_kelas = $_POST['nama_kelas'];

    $data = [
        'nama_kelas' => $nama_kelas
    ];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if ($id > 0) {
            $kelas->updateData($id, $data);
        }
    }else{
        $kelas->addData($data); 
    }
    header("Location: kelas.php");
    exit; 

}


$kelas->close();
$detail = new Template('templates/addKelas.html');
$detail->replace('ADD_DATA_NAMA', $Data_nama_kelas);
$detail->replace('ADD_DATA_UPLOAD', $Data_upload);
$detail->write();
?>
