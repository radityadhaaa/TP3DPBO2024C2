<?php

class Siswa extends DB
{
    function getSiswaJoin()
    {
        $query = "SELECT * FROM siswa JOIN kelas ON siswa.id_kelas=kelas.id_kelas JOIN jurusan ON siswa.id_jurusan=jurusan.id_jurusan ORDER BY siswa.id_siswa";

        return $this->execute($query);
    }

    function getSiswa()
    {
        $query = "SELECT * FROM siswa";
        return $this->execute($query);
    }

    function getSiswaById($id)
    {
        $query = "SELECT * FROM siswa JOIN kelas ON siswa.id_kelas=kelas.id_kelas JOIN jurusan ON siswa.id_jurusan=jurusan.id_jurusan WHERE id_siswa=$id";
        return $this->execute($query);
    }

    function searchSiswa($keyword)
    {
        $query = "SELECT * FROM siswa WHERE nama_siswa LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function addData($data)
    {   // id siswa tidak perlu karena bakan otomatis
        $query = "INSERT INTO `siswa`( `nama_siswa`, `id_jurusan`, `id_kelas`) VALUES('{$data['nama_siswa']}','{$data['id_jurusan']}','{$data['id_kelas']}')";
        return $this->execute($query);
    }

    function updateData($id, $data)
    {
        $query = "UPDATE siswa SET nama_siswa = '{$data['nama_siswa']}', id_jurusan = '{$data['id_jurusan']}', id_kelas = '{$data['id_kelas']}' WHERE id_siswa = $id";
        return $this->execute($query);
    }

    function deleteData($id)
    {
        // Disable foreign key checks
        $this->execute("SET FOREIGN_KEY_CHECKS=0");

        // Delete data from the siswa table
        $query = "DELETE FROM siswa WHERE id_siswa = $id";
        $result = $this->execute($query);

        // Re-enable foreign key checks
        $this->execute("SET FOREIGN_KEY_CHECKS=1");

        return $result;
    }

}
