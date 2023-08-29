<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= BASEURL; ?>css/bootstrap.css" rel="stylesheet">
    <title>Halaman <?php echo $data['judul']; ?></title>
</head>
<body>

<!-- Navbar -->
<header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="<?php echo BASEURL; ?>home" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <?php $src =  $data['judul'] == 'Home' ? "./img/MAALogo.png" : BASEURL . "img/MAALogo.png" ?>
          <img class="img-responsive border border-2 border-danger rounded-circle" style="width: 4vw; height: 4vw;" src=<?= $src;?> alt="">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <!-- Note kita gk mainan file lagi sekarangg tapi kita mainan link buat highlight href diatas sama bawah -->
          <li><a href="<?php echo BASEURL; ?>home" class="nav-link px-2 text-white">Home</a></li>
          <li><a href="<?php echo BASEURL; ?>mahasiswa" class="nav-link px-2 text-white">Mahasiswa</a></li>
          <li><a href="<?php echo BASEURL; ?>about/person" class="nav-link px-2 text-white">About</a></li>
        </ul>

        <?php if($data['judul'] == "Mahasiswa") {
          echo "<form action='" . BASEURL . "mahasiswa/search'" . "method='post' class='col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3'>
          <div class='input-group mb-3'>
            <input type='text' class='form-control' placeholder='Search...' name='searchFor'>
            <button class='btn btn-outline-success' type='submit' id='button-addon2'>Search</button>
          </div>
        </form>";
        }?>

      </div>
    </div>
</header>