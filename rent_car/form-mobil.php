<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Form Mobil</title>
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
                <h4 class="text-white">
                    Form Mobil
                </h4>
            </div>

            <div class="card-body">
                <?php
                if (isset($_GET["id_mobil"])) {
                    # form untuk edit
                    $id_mobil = $_GET["id_mobil"];
                    $sql = "select * from mobil where id_mobil='$id_mobil'";

                    include "connection.php";
                    #ekseukusi SQL
                    $hasil = mysqli_query($connect, $sql);

                    #konversi ke array
                    $mobil = mysqli_fetch_array($hasil);
                    ?>
                    <form action="process-mobil.php" method="post" enctype="multipart/form-data">
                    Id Mobil
                    <input type="text" name="id_mobil" class="form-control mb-2" required
                    value="<?=$mobil["id_mobil"];?>" readonly>

                    nomor_mobil
                    <input type="text" name="nomor_mobil" class="form-control mb-2" required
                    value="<?=$mobil["nomor_mobil"];?>">

                    merk
                    <input type="text" name="merk" class="form-control mb-2" required
                    value="<?=$mobil["merk"];?>">

                    jenis
                    <input type="text" name="jenis" class="form-control mb-2" required
                    value="<?=$mobil["jenis"];?>">

                    warna
                    <select name="warna" class="form-control mb-2" required>
                        <option value="<?=$mobil["warna"];?>" selected>
                           <?=$mobil["warna"]?>
                        </option>
                        <option value="hitam">Hitam</option>
                        <option value="putih">Putih</option>
                        <option value="silver">Silver</option>
                        <option value="biru">Biru</option>
                        <option value="merah">Merah</option>
                        <option value="kuning">Kuning</option>
                    </select>

                    Tahun Pembuatan 
                   <input type="date" name="tahun_pembuatan" class="form-control mb-2" required
                   value="<?=$mobil["tahun_pembuatan"];?>">

                   Biaya Sewa Perhari
                   <input type="number" name="biaya_sewa_per_hari" class="form-control mb-2" required
                   value="<?=$mobil["biaya_sewa_per_hari"];?>">

                    Pictures
                    <img src="pictures/<?=$mobil["image"]?>" width="200"><img>
                    <input type="file" name="image" class="form-control mb-2">

                    <button type="submit" class="btn btn-info btn-block" name="update_mobil">
                        Simpan
                    </button>
                </form>
                    <?php
                } else {
                    # form untuk insert
                    ?>
                    <form action="process-mobil.php" method="post" enctype="multipart/form-data">
                    Id Mobil
                    <input type="text" name="id_mobil" class="form-control mb-2" required>

                    Nomor Mobil
                    <input type="text" name="nomor_mobil" class="form-control mb-2" required>

                    Merk
                    <input type="text" name="merk" class="form-control mb-2" required>

                    jenis
                    <input type="text" name="jenis" class="form-control mb-2" required>

                    Warna
                    <select name="warna" class="form-control mb-2" required>
                        <option value="hitam">Hitam</option>
                        <option value="putih">Putih</option>
                        <option value="silver">Silver</option>
                        <option value="biru">Biru</option>
                        <option value="merah">Merah</option>
                        <option value="kuning">Kuning</option>
                    </select>

                    Tahun Pembuatan
                    <input type="date" name="tahun_pembuatan" class="form-control mb-2" required>

                    Biaya Sewa Perhari
                    <input type="number" name="biaya_sewa_perhari" class="form-control mb-2" required>

                    Pictures 
                    <input type="file" name="pictures" class="form-control mb-2" required>

                    <button type="submit" class="btn btn-info btn-block" name="simpan_mobil">
                        Simpan
                    </button>
                </form>
                    <?php
                }
                
                ?>
                
            </div>
        </div>
    </div>
</body>
</html>