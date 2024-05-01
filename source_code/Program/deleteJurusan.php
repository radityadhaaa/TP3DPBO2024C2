<?php
include('classes/Template.php');
include('config/db.php');
include('classes/DB.php');
include('classes/Jurusan.php');

$jurusan = new Jurusan($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$jurusan->open();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $jurusan->deleteData($id);
    }
}


$jurusan->close();
header("Location: jurusan.php");
exit;
?>
