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
                    $isbn = $_GET["id_mobil"];
                    $sql = "select * from mobil where id_mobil='$id_mobil'";

                    include "connection.php";
                    #ekseukusi SQL
                    $hasil = mysqli_query($connect, $sql);

                    #konversi ke array
                    $mobil = mysqli_fetch_array($hasil);
                    ?>
                    <form action="process-mobil.php" method="post" enctype="multipart/form-data">
                    Id Mobil
                    <input type="number" name="id_mobil" class="form-control mb-2" required
                    value=<?=$mobil["id_mobil"]?> readonly>

                    nomor_mobil
                    <input type="number" name="nomor_mobil" class="form-control mb-2" required
                    value=<?=$mobil["nomor_mobil"]?>>

                    merk
                    <input type="text" name="merk" class="form-control mb-2" required
                    value=<?=$merk["merk"]?>>

                    jenis
                    <input type="text" name="jenis" class="form-control mb-2" required
                    value=<?=$jenis["jenis"]?>>

                    warna
                    <select name="warna" class="form-control mb-2" required>
                        <option value="<?=$mobil["warna"]?>" selected>
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
                   value=<?=$tahun_pembuatan["tahun_pembuatan"]?>>

                   Biaya Sewa Perhari
                   <input type="number" name="biaya_sewa_perhari" class="form-control mb-2" required
                   value=<?=$biaya_sewa_perhari["biaya_sewa_perhari"]?>>

                    Pictures
                    <img src="pictures/<?=$mobil["pictures"]?>" width="200">
                    <input type="file" name="pictures" class="form-control mb-2">

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
                    <input type="number" name="id_mobil" class="form-control mb-2" required>

                    Nomor Mobil
                    <input type="number" name="nomor_mobil" class="form-control mb-2" required>

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