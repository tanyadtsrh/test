<?php
class Controller{
    // Bikin method view buat ngarahin user ke file html tapi ekstensinya .php
    public function view($viewFile,$data = []){
        require_once "../app/views/" . $viewFile . ".php";
    }

    public function model($modelName){
        require_once "../app/models/" . $modelName . ".php";
        return new $modelName;
    }
}