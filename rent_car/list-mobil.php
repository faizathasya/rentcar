<?php
session_start();
# jika saat load halaman ini, pastikan telah login sebagai karyawan
if (!isset($_SESSION["karyawan"])) {
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar mobil</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
  <a class="navbar-brand" href="RENTAL-MOBIL/list-sewa.php"> RENT CAR</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="list-mobil.php"> Mobil <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link active" href="list-pelanggan.php"> Pelanggan <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link active" href="list-karyawan.php"> Karyawan <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link active" href="list-sewa.php"> Sewa <span class="sr-only">(current)</span></a>
    </div>
  </div>
  <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>
        <div class="card">
            <div class="card-header bg-dark">
                <h3 class="text-white text-center">
                    Daftar mobil
                </h3>
                <a href="form-mobil.php">
                    <button class="btn btn-success form-control"> 
                        Add Car
                    </button>
                </a>
            </div>

            <div class="card-body">
                <form action="list-mobil.php" method="get">
                    <input type="text" name="search"
                    class="form-control mb-2" placeholder="cari">
                </form>

                <ul class="list-group"> 
                <?php
                include("connection.php");
                if (isset($_GET["search"])) {
                    $cari = $_GET["search"];
                    $sql = "select * from mobil where
                    nomor_mobil like '%$cari%'
                    or merk like '%$cari%'
                    or jenis like '%$cari%'
                    or warna like '%$cari%'
                    or tahun_pembuatan like '%$cari%'
                    or biaya_sewa like '%$cari%'";
                }else{
                    $sql = "select * from mobil";
                }

                # eksekusi SQL
                $hasil = mysqli_query($connect, $sql);
                while ($mobil = mysqli_fetch_array($hasil)) {
                ?>
                    <li class="list-group-item ">
                        <div class="row">
                            <div class="col-lg-4">
                                <!-- untuk gambar -->
                                <img src="pictures/<?=$mobil["image"]?>" width="100%">
                            </div>

                            <div class="col-lg-6 mt-2">
                                <!-- untuk deskripsi -->
                                <h5><b><?=$mobil["merk"]?></b></h5>
                                <h6>ID : <?=$mobil["id_mobil"]?></h6>
                                <h6>Nomor : <?=$mobil["nomor_mobil"]?></h6>
                                <h6>Merk : <?=$mobil["merk"]?></h6>
                                <h6>Jenis : <?=$mobil["jenis"]?></h6>
                                <h6>Warna : <?=$mobil["warna"]?></h6>
                                <h6>Tahun Pembuatan : <?=$mobil["tahun_pembuatan"]?></h6>
                                <h6>Biaya Sewa Rp : <?=$mobil["biaya_sewa_per_hari"]?></h6>
                            </div>

                            <div class="col-lg-2">
                                <a href="form-mobil.php?id_mobil=<?=$mobil["id_mobil"]?>">
                                    <button class="btn btn-info btn-block mb-2">
                                        Edit
                                    </button>
                                </a>

                                <a href="process-mobil.php?id_mobil=<?=$mobil["id_mobil"]?>"
                                onclick="return confirm('Are you sure delete this data?')">
                                    <button class="btn btn-danger btn-block">
                                        Delete
                                    </button>
                                </a>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>