<?php
class App{
    protected $controller = 'Home'; // ini = class
    protected $method = 'index'; // ini = function di class
    protected $params = [];
    public function __construct(){
        // echo 'OK!'; ini buat test classnya beneran berfungsi apa nggak
        $url = $this->parseURL(); //Jalanin fungsi parse
        // var_dump($url);
        // echo "<br> echo the url = $url";

        // Ini buat filter apakah controllernya ada atau nggak 
        //artinya public/omaga hasilnya bukan error tapi "Web tidak ada" gitu
        // $allControllers = ['home','about'];
        // $pageFound = true;
        // foreach ($allControllers as $controller) {
        //     if($url != NULL && $controller == $url[0]){
        //         $pageFound = true;
        //         break;
        //     } else {
        //         $pageFound = false;
        //     }
        // }
        // if(!$pageFound){
        //     echo "Page not Found 404";
        //     return;
        // }
        //Kalo $url[0] terdaftar di allControllers maka  page = trus dan akan lanjut ke next code

        // Controller
        if($url !== NULL && file_exists("../app/controllers/" . $url[0] . ".php")) {
        //Kalo ada file .php dengan nama sama dengan $url[0] didalam folder app/controllers
        $this->controller = $url[0];
        unset($url[0]); //controller dihapus dari array karena dia dh misah sendiri biar enak nanti buat params
        }

        require_once '../app/controllers/' . $this->controller . ".php";
        $this->controller = new $this->controller; //jadi bikin class baru setelah require filenya

        // method
        if(isset($url[1])){
            if(method_exists($this->controller, $url[1])){ 
            //kalo function di class $controller dengan nama $url[1] itu ada maka code jalan :
            $this->method = $url[1];
            unset($url[1]);
            }
        }

        // params
        if(!empty($url)){
            //Kalo url nya gk kosong dalam artian sisa params maka
            $this->params = array_values($url); //ngambil sisa url jadiin params
        }

        // Jalankan controller & method, serta kirimkan params jika ada
        call_user_func_array([$this->controller,$this->method],$this->params);
        //Jadi dia bakalan ngejalanin new Class trus jalanin function didalam Class itu
        //Nah parameter functionnya nanti = $this->params
        // new Controller->method(params);

        // Dan bakalan set secara default kalo gk ketemu filenya ke Home soalnya controller = "Home" dari awal
    }

    //buat nangkep url + parsing biar rapih
    public function parseURL(){
        if($_GET != [] && $_GET['url']){
            // $url = $_GET['url']; ini versi normal
            $url = rtrim($_GET['url'],'/'); //ini buat ngapus / diakhir url biar rapih
            $url = filter_var($url, FILTER_SANITIZE_URL); //ini untuk mencegah dari karakter yang jahat
            // filter_var url biar gk kena SQL Injection

            // Memecah string dari _GET url menjadi array untuk setiap per / (slash)
            $url = explode('/',$url);
            return $url;
        } else {
            return;
        }
        // _GET kalo di var_dump isinya array object trus ada key 'url' => 'namaurl gitu'
    }
}