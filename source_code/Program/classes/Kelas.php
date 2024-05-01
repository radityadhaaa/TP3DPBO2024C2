<?php

class Kelas extends DB
{
    function getKelas()
    {
        $query = "SELECT * FROM kelas";
        return $this->execute($query);
    }

    function getKelasById($id)
    {
        $query = "SELECT * FROM kelas WHERE id_kelas=$id";
        return $this->execute($query);
    }

    function searchKelas($keyword)
    {
        $query = "SELECT * FROM kelas WHERE nama_kelas LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function addData($data)
    {   
        $query = "INSERT INTO `kelas`(`nama_kelas`)VALUES('{$data['nama_kelas']}')";
        return $this->execute($query);
    }

    function updateData($id, $data)
    {
        $query = "UPDATE kelas SET nama_kelas = '{$data['nama_kelas']}' WHERE id_kelas = $id";
        return $this->execute($query);
    }

    function deleteData($id)
    {
        // Disable foreign key checks
        $this->execute("SET FOREIGN_KEY_CHECKS=0");

        // Delete data from the siswa table
        $query = "DELETE FROM kelas WHERE id_kelas = $id";
        $result = $this->execute($query);

        // Re-enable foreign key checks
        $this->execute("SET FOREIGN_KEY_CHECKS=1");

        return $result;
    }
}
