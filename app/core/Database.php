<?php
require_once '../app/core/Config.php';
class Database {
    private $host = DB_HOST;
    private $database = DB_NAME;
    private $user = DB_USER;
    private $password = DB_PASS;

    private $dbh; //database handler semacam connection
    private $stmt; //statement

    public function __construct(){
        $option = [
            PDO::ATTR_PERSISTENT => true, //biar koneksinya terjaga
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //kalo error masuknya ke ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password, $option);
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    public function query($query){ //fungsi buat masukin query
        $this->stmt = $this->dbh->prepare($query); 
        //ini tuh mirip connection->query("PERINTAH"); tapi anti SQL Inject dan harus di exec diakhir
        //serta resultnya harus di fetch biar keluar
    }

    public function bind($param, $value, $type = NULL){
        //ini buat binding datanya
        if(is_null($type)){
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }

        //bindValue atau bindParam digunakan untuk mengikat :value dengan value asli
        // :value disebut $param dan value asli disebut $value contoh penggunaan aslinya gini
        // $this->dbh->prepare("SELECT username FROM users WHERE user_id = :id)
        // bindValue(":id", $id)

        $this->stmt->bindValue($param, $value, $type);
        //nah buat $type itu cuman opsi tambahan aja
    }

    //prepare butuh dieksekusi dengan PDO execute biar nangkep datanya
    public function executeDatabase(){
        $this->stmt->execute();
    }

    //setelah prepare di tangkep hasilnya dengan execute PDO kita harus menentukan dalam bentuk apa hasilnya
    
    //kalo hasilnya banyak dan mau dijadiin array asosiatifs (array object)
    public function resultSet(){
        $this->executeDatabase();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //kalo hasilnya satu atau single
    public function single(){
        $this->executeDatabase();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buat detect apakah ada perubahan dalam database atau tidak
    public function rowCountDatabase(){
        return $this->stmt->rowCount();
        //rowCount() untuk mendeteksi berapa banyak baris yang terdampak perubahan baik tambah,update,delete
    }
}


// Note penting :
// function bind digunakan kalo kita mau INSERT DELETE atau UPDATE
// sedangkan resultSet() digunakan kalo kita mau SELECT data 

// kalo mau INSERT DELETE atau UPDATE caranya gunakan query("PErintah) kemudian bind() lalu executeDatabase()
// kalo mau SELECT caranya gunakan query("Perintah") kemudian resultSet() atau single();