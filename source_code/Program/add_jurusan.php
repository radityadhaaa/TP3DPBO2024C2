<?php

include('classes/Template.php');
include('config/db.php');
include('classes/DB.php');
include('classes/Jurusan.php');

$jurusan = new Jurusan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$jurusan->open();
$jurusan->getJurusan();

$Data_nama_jurusan = '';
$Data_upload = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $jurusan->getJurusanById($id);
        $row = $jurusan->getResult();

        $Data_nama_jurusan = $row['nama_jurusan'];
        $Data_upload .= 'add_jurusan.php?id='.$row['id_jurusan'].'';
    }
}else{
    $Data_upload .= 'add_jurusan.php';
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama_jurusan = $_POST['nama_jurusan'];

    $data = [
        'nama_jurusan' => $nama_jurusan
    ];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if ($id > 0) {
            $jurusan->updateData($id, $data);
        }
    }else{
        $jurusan->addData($data); 
    }
    header("Location: jurusan.php");
    exit;

}


$jurusan->close();
$detail = new Template('templates/addJurusan.html');
$detail->replace('ADD_DATA_NAMA', $Data_nama_jurusan);
$detail->replace('ADD_DATA_UPLOAD', $Data_upload);
$detail->write();
?>
