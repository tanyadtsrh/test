<?php

//class = controller
class Home extends Controller{
    //function = method
    public function index(){
        // view = fungsi untuk require_once yang langsung ke file .php
        $data['judul'] = 'Home';
        $data['nama'] = $this->model('User_model')->getUser(); //$data['nama'] diambil dari sini get_user
        $this->view('templates/header',$data);
        $this->view('home/index',$data);
        $this->view('templates/footer');
    }
}