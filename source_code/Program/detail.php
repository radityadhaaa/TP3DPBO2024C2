<?php
include('classes/Template.php');
include('config/db.php');
include('classes/DB.php');
include('classes/Jurusan.php');
include('classes/Kelas.php');
include('classes/Siswa.php');

$siswa = new Siswa($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$siswa->open();

$data = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $siswa->getSiswaById($id);
        $row = $siswa->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['nama_siswa'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['nama_siswa'] . '</td>
                                </tr>
                                <tr>
                                    <td>Kelas</td>
                                    <td>:</td>
                                    <td>' . $row['nama_kelas']  .' '.  $row['nama_jurusan'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="add_siswa.php?id='.$row['id_siswa'].'"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="deleteSiswa.php?id='.$row['id_siswa'].'"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

$siswa->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_SISWA', $data);
$detail->write();
?>
