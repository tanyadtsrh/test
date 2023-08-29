<?php

class Mahasiswa_model{
    private $mahasiswa; //kalo ada disini gunakan this
    private $table = "mahasiswa";
    public function __construct(){
        $connection = new Database;
        $connection->query("SELECT * FROM $this->table ORDER BY nama");
        $this->mahasiswa = $connection->resultSet();

        // close connection
        $connection = NULL;
    }

    public function getAllMahasiswa(){
        return $this->mahasiswa;
    }

    public function getMahasiswaById($id){
        $connection = new Database;
        $connection->query("SELECT * FROM $this->table WHERE id=:id");
        $connection->bind("id",$id);
        return $this->mahasiswa = $connection->single();

        // close connection
        $connection = NULL;
    }

    public function tambahMahasiswa($data){
        $query = "INSERT INTO $this->table 
                VALUES (:nama, :jurusan, :id)";
        
        $connection = new Database;
        $connection->query($query);
        $connection->bind('nama',$data['nama']);
        $connection->bind('jurusan',$data['jurusan']);
        $connection->bind('id',$data['id']);
        $connection->executeDatabase();

        $rowReturn = $connection->rowCountDatabase(); //buat direturn nanti patokan berhasil atau tidak
        $connection = NULL;

        return $rowReturn;
    }    

    public function hapusMahasiswa($id){
        $connection = new Database;
        $query = "DELETE FROM mahasiswa WHERE id=:id";
        $connection->query($query);
        $connection->bind("id",$id);
        $connection->executeDatabase();

        $rowReturn = $connection->rowCountDatabase();
        $connection = NULL;

        return $rowReturn;
    }

    public function editMahasiswa($data){
        $query = "UPDATE mahasiswa SET 
        nama = :nama,
        jurusan = :jurusan 
        WHERE id = :id";

        $connection = new Database;
        $connection->query($query);
        $connection->bind("nama",$data['nama']);
        $connection->bind("id",$data['id']);
        $connection->bind("jurusan",$data['jurusan']);
        $connection->executeDatabase();

        $rowReturn = $connection->rowCountDatabase();
        $connection = NULL;

        return $rowReturn;
    }

    public function searchMahasiswa($searchFor){
        $query = "SELECT * FROM mahasiswa 
        WHERE nama LIKE :searchFor 
        OR id = :searchForId
        OR jurusan LIKE :searchFor;"; //LIKE harusnya %cari% tapi karena PDO % jadi error kalo ditaro disini

        $connection = new Database;
        $connection->query($query);
        $connection->bind("searchFor","%$searchFor%"); // taro % pas binding biar gk error
        $connection->bind("searchForId",$searchFor); // id gk perlu % soalnya harus akurat
        $connection->executeDatabase();

        $returnResult = $connection->resultSet();
        $connection = NULL;

        return $returnResult;
    }
}