<?php
include('classes/Template.php');
include('config/db.php');
include('classes/DB.php');
include('classes/Jurusan.php');
include('classes/Kelas.php');
include('classes/Siswa.php');

$siswa = new Siswa($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$siswa->open();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $siswa->deleteData($id);
    }
}


$siswa->close();
header("Location: index.php");
exit;
?>
