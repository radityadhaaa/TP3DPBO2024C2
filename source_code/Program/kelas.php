<?php
include('classes/Template.php');
include('config/db.php');
include('classes/DB.php');
include('classes/Kelas.php');

$kelas = new Kelas($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$kelas->open();
$kelas->getKelas();

if (isset($_POST['btn-cari'])) {
    $kelas->searchKelas($_POST['cari']);
} else {
    $kelas->getKelas();
}

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($kelas->addData($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'kelas.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'kelas.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Kelas';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama kelas</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'Kelas';

while ($div = $kelas->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['nama_kelas'] . '</td>
    <td style="font-size: 22px;">
        <a href="add_kelas.php?id=' . $div['id_kelas'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="deleteKelas.php?id=' . $div['id_kelas'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($kelas->updateData($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'kelas.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'kelas.php';
            </script>";
            }
        }

        $kelas->getKelasById($id);
        $row = $kelas->getResult();

        $dataUpdate = $row['nama_kelas'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($kelas->deleteData($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'kelas.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'kelas.php';
            </script>";
        }
    }
}

$kelas->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
