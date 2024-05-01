<?php
include('classes/DB.php');
include('classes/Siswa.php');
include('classes/Jurusan.php');
include('classes/Template.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get the data from the form
    $id_siswa = $_POST['id_siswa'];
    $nama_siswa = $_POST['nama_siswa'];
    $id_jurusan = $_POST['id_jurusan'];
    $id_kelas = $_POST['id_kelas'];

    $data = array(
        'nama_siswa' => $nama_siswa,
        'id_jurusan' => $id_jurusan,
        'id_kelas' => $id_kelas
    );

    $siswa->updateData($id_siswa, $data);
}

$id_siswa = $_GET['id_siswa'];
$dataSiswa = $siswa->getData($id_siswa);

$detail->replace('id_siswa', $dataSiswa['id_siswa']);
$detail->replace('nama_siswa', $dataSiswa['nama_siswa']);
$detail->replace('id_jurusan', $dataSiswa['id_jurusan']);
$detail->replace('id_kelas', $dataSiswa['id_kelas']);

$detail->write();
?>
