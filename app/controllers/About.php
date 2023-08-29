<?php

class About extends Controller{
    // Ini buat set default kalo cuman /About/
    public function index(){
        $data['judul'] = 'About';
        $this->view('templates/header',$data);
        $this->view('home/index');
        $this->view('templates/footer');
    }

    public function page(){
        $data['judul'] = 'Page';
        $this->view('templates/header',$data);
        $this->view('page/index');
        $this->view('templates/footer');
    }

    // test function with params | params nya berasal dari app.php yang dikirim lewat user_call_func
    public function person($nama = "Koumaa",$pekerjaan = "Web Developer",$umur = 18){
        //params $nama dan $pekerjaan didapatkan setelah url about/person/udin/jurnalis contohnya
        // echo "Halo, nama saya $nama, saya adalah seorang $pekerjaan";

        $data['nama'] = $nama;
        $data['pekerjaan'] = $pekerjaan;
        $data['umur'] = $umur;
        $data['judul'] = 'Person';
        $this->view('templates/header',$data);
        $this->view('person/index',$data); //data adalah array
        $this->view('templates/footer');
    }
}