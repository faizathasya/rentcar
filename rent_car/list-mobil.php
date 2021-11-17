<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>List Mobil</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="text-white">
                    Daftar Mobil
                </h4>
            </div>

            <div class="card-body">
                <form action="list-mobil.php" method ="get">
                    <input type="text" name="search" class="form-control mb-2"
                    placeholder="Search Your Data" />
                </form>

                <ul class="list-group">
                    <?php
                    include "connection.php";
                    if (isset($_GET["search"])) {
                        $cari = $_GET["search"];
                        $sql = "select * from mobil 
                        where nomor_mobil like '%$cari%' 
                        or merk like '%$cari%' 
                        or jenis like '%$cari%'
                        or warna like '%$cari%'
                        or tahun_pembuatan like '%$cari%'
                        or biaya_sewa_per_hari like '%cari%'";
                    
                    }else {
                        $sql = "select * from mobil";
                    }
                    # eksekusi SQL
                    $hasil = mysqli_query($connect, $sql);
                    while ($mobil = mysqli_fetch_array($hasil)) {
                        ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- untuk gambar -->
                                    <img src="pictures/<?=$mobil["image"]?>" width="300" />
                                </div>
                                <div class="col-lg-6">
                                    <!-- untuk deskripsi buku -->
                                    <h5><?=$mobil["nomor_mobil"]?></h5>
                                    <h6>Merk : <?=$mobil["merk"]?></h6>
                                    <h6>Jenis : <?=$mobil["jenis"]?></h6>
                                    <h6>warna : <?=$mobil["warna"]?></h6>
                                    <h6>Tahun Pembuaatn : <?=$mobil["tahun_pembuatan"]?></h6>
                                    <h6>Biaya Sewa Per hari : <?=$mobil["biaya_sewa_per_hari"]?></h6>
                                </div>
                                <div class="col-lg-2">
                                    <a href="form-mobil.php?id_mobil=<?=$mobil["id_mobil"]?>">
                                        <button class="btn btn-info btn-block">
                                            Edit
                                        </button>
                                    </a>
                                    
                                    <a href="process-mobil.php?id_mobil=<?=$mobil["id_mobil"]?>"
                                    onclick="return confrim('R U Sure?')">
                                    
                                    <button class="btn btn-danger btn-block">
                                        Hapus
                                    </button>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>

                 <!-- button tambah data -->
                 <a href="form-mobil.php">
                    <button class="btn btn-success">
                        Tambah Data Mobil                  
                     </button>
                </a>
            </div>
        </div>
    </div>
</body>
</html>