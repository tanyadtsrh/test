<?php
//Ini folder default buat XAMPP tapi bikin sendiri
//kalo namanya bukan index.php ntr gk kebaca di XAMPP nya harus kecil semua

// Aktifin _SESSION biar bisa dipanggil

if (!session_id()) {
    session_start();
} else {
    return;
}

require_once '../app/init.php'; //bootstraping = memanggil semua class dari folder app tanpa manual satu-satu

$app = new App;