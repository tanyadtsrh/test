<?php

class Mahasiswa extends Controller {
    public function index(){
        $data['judul'] = "Mahasiswa";
        $data['mahasiswa'] = $this->model("Mahasiswa_model")->getAllMahasiswa(); //hasilnya array didalam array
        $this->view("templates/header",$data);
        $this->view("mahasiswa/index",$data);
        $this->view("templates/footer");
    }

    public function detail($id){
        $data['judul'] = "Mahasiswa";
        $data['mahasiswa'] = $this->model("Mahasiswa_model")->getMahasiswaById($id); //hasilnya array didalam array
        $this->view("templates/header",$data);
        $this->view("mahasiswa/detail",$data);
        $this->view("templates/footer");
    }
    //$id berasal dari $this->params yang ada di core App.php
    //kan gini nanti di linknya bakalan /controller/method/param1/param2/param3
    //nah karena link akhir untuk detail paramnya cuman 1 jadinya otomatis masuknya cuman 1 yaitu id

    //link akhir untuk detail = /mahasiswa/detail/1111
    //maka nanti si call_user_func_array([$this->controller,$this->method],$params) akan jadi seperti ini
    // new Mahasiswa->detail(1111);

    //kalo masih bingung baca ulang lagi aja App.php nya

    // insert data
    public function tambah(){
        // var_dump($_POST); buat cek aja semua method post bakal ke kirim ke $_POST

        if($this->model("Mahasiswa_model")->tambahMahasiswa($_POST) > 0){
            Flasher::setFlash('Berhasil','Data berhasil dimasukkan','success');
            header('Location:' . BASEURL . 'mahasiswa'); //ini buat ngebalikin ke halaman mahasiswa (preventDefault)
            //Location : salah yang benar Location:
            exit;
        } else {
            Flasher::setFlash('Gagal','Data gagal dimasukkan','danger');
            header('Location:' . BASEURL . 'mahasiswa'); //ini buat ngebalikin ke halaman mahasiswa (preventDefault)
            //Location : salah yang benar Location:
            exit;
        }
    }

    //$id dapet dari call_func_user_arr
    public function hapus($id){
        if ($this->model("Mahasiswa_model")->hapusMahasiswa($id) > 0) {
            Flasher::setFlash("Berhasil","Data berhasil dihapus dari Database","success");
            header("Location:" . BASEURL . "mahasiswa");
            exit;
        } else {
            Flasher::setFlash("Gagal","Data gagal dihapus dari Database","danger");
            header("Location:" . BASEURL . "mahasiswa");
            exit;
        }
    }

    public function getedit(){
        echo json_encode($this->model("Mahasiswa_model")->getMahasiswaById($_POST['id']));
    }

    public function edit(){
        if ($this->model("Mahasiswa_model")->editMahasiswa($_POST) > 0) {
            Flasher::setFlash("Berhasil","Data berhasil diubah dari Database","success");
            header("Location:" . BASEURL . "mahasiswa");
            exit;
        } else {
            Flasher::setFlash("Gagal","Data gagal diubah dari Database","danger");
            header("Location:" . BASEURL . "mahasiswa");
            exit;
        }
    }

    public function search(){
        $searchFor = $_POST['searchFor'];
        if ($this->model("Mahasiswa_model")->searchMahasiswa($_POST['searchFor']) !== []) {
            Flasher::setFlash("Ketemu","Pencarian untuk $searchFor","success");
            
            $data['judul'] = 'Mahasiswa';
            $data['mahasiswa'] = $this->model("Mahasiswa_model")->searchMahasiswa($_POST['searchFor']);
            $this->view("templates/header",$data);
            $this->view("mahasiswa/index",$data);
            $this->view("templates/footer");
        } else {
            $this->model("Mahasiswa_model")->getAllMahasiswa();
            Flasher::setFlash("Tidak Ditemukan","Pencarian untuk $searchFor gagal","danger");
            header("Location:" . BASEURL . "mahasiswa");
            exit;
        }
    }
}