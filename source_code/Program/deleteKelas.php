<?php
include('classes/Template.php');
include('config/db.php');
include('classes/DB.php');
include('classes/Kelas.php');

$kelas = new Kelas($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$kelas->open();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $kelas->deleteData($id);
    }
}


$kelas->close();
header("Location: kelas.php");
exit;
?>
