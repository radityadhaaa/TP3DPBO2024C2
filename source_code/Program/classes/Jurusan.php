<?php

class Jurusan extends DB
{
    function getJurusan()
    {
        $query = "SELECT * FROM jurusan";
        return $this->execute($query);
    }

    function getJurusanById($id)
    {
        $query = "SELECT * FROM jurusan WHERE id_jurusan=$id";
        return $this->execute($query);
    }

    function searchJurusan($keyword)
    {
        $query = "SELECT * FROM jurusan WHERE nama_jurusan LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function addData($data)
    {   
        $query = "INSERT INTO `jurusan`(`nama_jurusan`)VALUES('{$data['nama_jurusan']}')";
        return $this->execute($query);
    }

    function updateData($id, $data)
    {
        $query = "UPDATE jurusan SET nama_jurusan = '{$data['nama_jurusan']}' WHERE id_jurusan = $id";
        return $this->execute($query);
    }

    function deleteData($id)
    {
        // Disable foreign key checks
        $this->execute("SET FOREIGN_KEY_CHECKS=0");

        // Delete data from the siswa table
        $query = "DELETE FROM jurusan WHERE id_jurusan = $id";
        $result = $this->execute($query);

        // Re-enable foreign key checks
        $this->execute("SET FOREIGN_KEY_CHECKS=1");

        return $result;
    }
}
