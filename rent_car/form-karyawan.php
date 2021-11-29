<?php
session_start();
# jika saat load halaman ini, pastikan telah login
# sbg petugas
if (!isset($_SESSION["petugas"])) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Form Karyawan </title>
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
                <h4 class="text-white">Form Karyawan</h4>
            </div>

            <div class="card-body">
                <?php
                if(isset($_GET["id_karyawan"])){
                    # mengakses data karyawan dari id_karyawan yg dikirim
                    include "connection.php";
                    $id_karyawan = $_GET["id_karyawan"];
                    $sql = "select * from karyawan where id_karyawan='$id_karyawan'";
                    // eksekusi perintah SQL
                    $hasil = mysqli_query($connect, $sql);
                    # konversi hasil query ke bentuk array
                    $karyawan = mysqli_fetch_array($hasil);
                    ?>
                    <form action="process-karyawan.php" method="post"
                    onsubmit="return confirm ('Are u sure want to edit this?')">

                    ID Karyawan
                    <input type="text" name="id_karyawan" 
                    class="form-control mb-2" required
                    value="<?=$karyawan["id_karyawan"];?>" readonly />

                    Nama karyawan
                    <input type="text" name="nama_karyawan" 
                    class="form-control mb-2" required
                    value="<?=$karyawan["nama_karyawan"];?>" />

                    Alamat karyawan
                    <input type="text" name="alamat_karyawan" 
                    class="form-control mb-2" required
                    value="<?=$karyawan["alamat_karyawan"];?>" />

                    kontak
                    <input type="text" name="kontak" 
                    class="form-control mb-2" required
                    value="<?=$karyawan["kontak"];?>" />

                    Username
                    <input type="text" name="username" 
                    class="form-control mb-2" required
                    value="<?=$karyawan["username"];?>" />

                    Password
                    <input type="password" name="password" 
                    class="form-control mb-2" />

                    <button type="submit" class="btn btn-success btn-block"
                    name="edit_karyawan">
                        Simpan
                    </button>
                    </form>
                    <?php
                }else{
                    // jika false, maka form petugas digunakan untuk insert
                    ?>
                    <form action="process-karyawan.php" method="post">
                    ID Karyawan
                    <input type="text" name="id_karyawan" 
                    class="form-control mb-2" required />

                    Nama Karyawan
                    <input type="text" name="nama_karyawan" 
                    class="form-control mb-2" required/>

                    Alamat Karyawan
                    <input type="text" name="alamat_karyawan"
                    class="form-control mb-2" required>

                    kontak
                    <input type="text" name="kontak" 
                    class="form-control mb-2" required/>

                    Username
                    <input type="text" name="username" 
                    class="form-control mb-2" required />

                    Password
                    <input type="password" name="password" 
                    class="form-control mb-2"  />

                    <button type="submit" class="btn btn-success btn-block"
                    name="simpan_karyawan">
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