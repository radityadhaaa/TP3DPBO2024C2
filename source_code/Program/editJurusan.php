<?php
include('classes/DB.php');
include('classes/Jurusan.php');
include('classes/Template.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_jurusan = $_POST['id_jurusan'];
    $nama_jurusan = $_POST['nama_jurusan'];

    $data = array(
        'nama_jurusan' => $nama_jurusan
    );

    $jurusan->updateData($id_jurusan, $data);
}

$id_jurusan = $_GET['id_jurusan'];
$dataJurusan = $jurusan->getData($id_jurusan);

$detail->replace('id_jurusan', $dataJurusan['id_jurusan']);
$detail->replace('nama_jurusan', $dataJurusan['nama_jurusan']);

$detail->write();
?>
