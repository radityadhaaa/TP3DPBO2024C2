<?php
include('classes/Template.php');
include('config/db.php');
include('classes/DB.php');
include('classes/Siswa.php');
include('classes/Kelas.php');
include('classes/Jurusan.php');


$listSiswa = new Siswa($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$listSiswa->open();

$listSiswa->getSiswaJoin();

if (isset($_POST['btn-cari'])) {
    $listSiswa->searchSiswa($_POST['cari']);
} else {
    $listSiswa->getSiswaJoin();
}

$data = null;

while ($row = $listSiswa->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 siswa-thumbnail">
        <a href="detail.php?id=' . $row['id_siswa'] . '">
            <div class="card-body">
                <p class="card-text nama-siswa my-0">' . $row['nama_siswa'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

$listSiswa->close();

$home = new Template('templates/skin.html');

$home->replace('DATA_SISWA', $data);
$home->write();
