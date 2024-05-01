<?php
include('classes/DB.php');
include('classes/kelas.php');
include('classes/Template.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get the data from the form
    $id_kelas = $_POST['id_kelas'];
    $nama_kelas = $_POST['nama_kelas'];

    $data = array(
        'nama_kelas' => $nama_kelas
    );


    $kelas->updateData($id_kelas, $data);
}


$id_kelas = $_GET['id_kelas'];
$dataKelas = $kelas->getData($id_kelas);

$detail->replace('id_kelas', $dataKelas['id_kelas']);
$detail->replace('nama_kelas', $dataKelas['nama_kelas']);

$detail->write();
?>
