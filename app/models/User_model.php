<?php

class User_model{
    private $name = "Koumaa";

    public function getUser(){
        return $this->name; //catatan penting sekali $this->$name itu salah, tanda dolar $ cukup 1 diawal aja
    }
}